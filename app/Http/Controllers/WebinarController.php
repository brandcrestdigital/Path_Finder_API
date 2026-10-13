<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Webinar;
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    /**
     * Create Webinar API
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                  => 'required|string|max:255',
            'date'                   => 'required|date|after_or_equal:today',
            'start_time'             => 'required|date_format:H:i',
            'end_time'               => 'required|date_format:H:i|after:start_time',
            'description'            => 'required|string|max:5000',
            'status'                 => 'nullable|in:pending,upcoming,live,completed,cancelled',
            'restricted_application' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // dd($request->date);

        $user = auth()->user();

        // Check if user has Google token
        if (! $user->google_token) {
            return response()->json([
                'success' => false,
                'message' => 'Google account not connected. Please login with Google first.',
            ], 401);
        }

        try {
            $meetingLink = $this->createGoogleMeetLink($user, $request);

            $webinar = Webinar::create([
                'title'                  => $request->title,
                'slug'                   => $this->generateUniqueSlug($request->title),
                'date'                   => $request->date,
                'start_time'             => $request->start_time,
                'end_time'               => $request->end_time,
                'description'            => $request->description,
                'meeting_link'           => $meetingLink,
                'added_by'               => $user->id,
                'status'                 => $request->status ?? 'pending',
                'restricted_application' => $request->restricted_application ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Webinar created successfully with Google Meet link',
                'data'    => $webinar,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Google Meet: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create Gmeet Link
     */

    private function createGoogleMeetLink($user, $request)
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));

        // Important: Set both access token and refresh token
        $client->setAccessToken([
            'access_token'  => $user->google_token,
            'refresh_token' => $user->google_refresh_token,
            'expires_in'    => $user->google_token_expires_at
                ? $user->google_token_expires_at->diffInSeconds(now())
                : 3600,
        ]);

        // Auto refresh if token is expired
        if ($client->isAccessTokenExpired()) {
            if (empty($user->google_refresh_token)) {
                throw new \Exception('Refresh token is missing. Please reconnect your Google account.');
            }

            $newToken = $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);

            // Update user with new token
            $user->update([
                'google_token'            => $newToken['access_token'],
                'google_token_expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
            ]);
        }

        $service = new Calendar($client);

        $startDateTime = Carbon::parse($request->date . ' ' . $request->start_time, config('app.timezone'));
        $endDateTime   = Carbon::parse($request->date . ' ' . $request->end_time, config('app.timezone'));

        $event = new Calendar\Event([
            'summary'        => $request->title,
            'description'    => $request->description,
            'start'          => [
                'dateTime' => $startDateTime->toIso8601String(),
                'timeZone' => config('app.timezone'),
            ],
            'end'            => [
                'dateTime' => $endDateTime->toIso8601String(),
                'timeZone' => config('app.timezone'),
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId'             => uniqid('meet_'),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        $event = $service->events->insert('primary', $event, [
            'conferenceDataVersion' => 1,
        ]);

        return $event->getHangoutLink();
    }

    /**
     * Generate Unique Slug
     */
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $baseSlug = Str::slug($title);
        $slug     = $baseSlug;
        $count    = 1;

        while (Webinar::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Get All Webinars (List)
     */
    public function index(Request $request)
    {
        // $webinars = Webinar::with('addedBy') // eager load added by user
            $webinars = Webinar::with(['addedBy'])          // only load what you need
        ->withCount('applications')                 // ✅ adds applications_count
        ->latest()
        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Webinars fetched successfully',
            'data'    => $webinars,
            'meta'    => [
                'current_page' => $webinars->currentPage(),
                'last_page'    => $webinars->lastPage(),
                'per_page'     => $webinars->perPage(),
                'total'        => $webinars->total(),
            ],
        ]);
    }

    /**
     * Update Webinar
     */
    public function update(Request $request, $slug)
    {
        $webinar = Webinar::where('slug', $slug)->first();

        if (! $webinar) {
            return response()->json([
                'success' => false,
                'message' => 'Webinar not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'                  => 'required|string|max:255',
            'date'                   => 'required|date|after_or_equal:today',
            'start_time'             => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $startDateTime = Carbon::parse($request->date . ' ' . $value, config('app.timezone'));
                    if ($startDateTime->isPast()) {
                        $fail('The start time must be in the future.');
                    }
                },
            ],
            'end_time'               => 'required|date_format:H:i|after:start_time',
            'description'            => 'required|string|max:5000',
            'status'                 => 'nullable|in:pending,upcoming,live,completed,cancelled',
            'restricted_application' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $currentApplications = Application::where('webinar_id', $webinar->id)->count();

        if ($request->restricted_application < $currentApplications) {
            return response()->json([
                'success' => false,
                'message' => "Restricted application limit cannot be less than the current number of registered applicants ({$currentApplications}).",
            ], 422);
        }

        $webinar->update([
            'title'                  => $request->title,
            'slug'                   => $this->generateUniqueSlug($request->title, $webinar->id), // pass id to avoid self conflict
            'date'                   => $request->date,
            'start_time'             => $request->start_time,
            'end_time'               => $request->end_time,
            'description'            => $request->description,
            'status'                 => $request->status ?? $webinar->status,
            'restricted_application' => $request->restricted_application ?? $webinar->restricted_application,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Webinar updated successfully',
            'data'    => $webinar->fresh(),
        ]);
    }

    /**
     * Get Single Webinar (for Edit Form)
     */
    public function show($slug)
    {
        $webinar = Webinar::where('slug', $slug)
            ->with('addedBy')
            ->first();

        if (! $webinar) {
            return response()->json([
                'success' => false,
                'message' => 'Webinar not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $webinar,
        ]);
    }

    /**
     * Delete Webinar
     */
    public function destroy($slug)
    {
        $webinar = Webinar::where('slug', $slug)->first();

        if (! $webinar) {
            return response()->json([
                'success' => false,
                'message' => 'Webinar not found',
            ], 404);
        }

        // Optional: Add authorization check (only creator or admin can delete)
        // if ($webinar->added_by !== auth()->id() && !auth()->user()->isAdmin()) {
        //     return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        // }

        $webinar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Webinar deleted successfully',
        ], 200);
    }

    /**
     * Get Seminar Registrations List (For Admin Dashboard)
     */
    public function registrations()
    {
        $webinars = Webinar::withCount('applications') // Count registered students
            ->with('applications')                         // Optional: if you want full data
                                                       // ->where('status', '!=', 'pending')             // Show completed/upcoming etc.
            ->orderBy('date', 'desc')
            ->get();

        $data = $webinars->map(function ($webinar) {
            return [
                'id'                     => $webinar->id,
                'title'                  => $webinar->title,
                'slug'                   => $webinar->slug,
                'date'                   => $webinar->date->format('d F Y'),
                'start_time'             => $webinar->start_time,
                'end_time'               => $webinar->end_time,
                'status'                 => $webinar->status,
                'students_registered'    => $webinar->applications_count,    // Important
                'registrations'          => $webinar->applications->count(), // fallback
                'restricted_application' => $webinar->restricted_application,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Seminar registrations fetched successfully',
            'data'    => $data,
        ]);
    }

    /**
     * Get All Registrations for a Specific Webinar
     */
    public function getRegistrationsByWebinar(Request $request, $webinarId)
    {
        $webinar = Webinar::find($webinarId);

        if (! $webinar) {
            return response()->json([
                'success' => false,
                'message' => 'Webinar not found',
            ], 404);
        }

        $applications = Application::where('webinar_id', $webinarId)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $applications->map(function ($app) {
            return [
                'id'           => $app->id,
                'student_name' => $app->full_name,
                'email'        => $app->email,
                'phone'        => $app->phone,
                'class'        => $app->current_class ?? $app->school_college,
                'applied_date' => $app->created_at->format('d M Y'),
                'status'       => $app->status,
                'attendance'   => $app->attendance, // You can add attendance logic later
            ];
        });

        return response()->json([
            'success'             => true,
            'webinar'             => [
                'id'    => $webinar->id,
                'title' => $webinar->title,
                'date'  => $webinar->date->format('d F Y'),
                'time'  => $webinar->start_time . ' - ' . $webinar->end_time,
            ],
            'total_registrations' => $applications->count(),
            'data'                => $data,
        ]);
    }

    /**
     * Mark Attendance (Present / Absent)
     */
    public function markAttendance(Request $request, $applicationId)
    {
        $application = Application::find($applicationId);

        if (! $application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'attendance' => 'required|in:present,absent',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $application->update([
            'attendance' => $request->attendance,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully as ' . ucfirst($request->attendance),
            'data'    => $application,
        ]);
    }
}