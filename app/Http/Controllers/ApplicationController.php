<?php
namespace App\Http\Controllers;

use App\Mail\ApplicationSubmitted;
use App\Mail\WebinarApprovalMail;
use App\Models\Application;
use App\Models\Webinar;
use Illuminate\Http\Request; // Create this mail class
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'webinar_id'          => 'required|exists:webinars,id',
            'full_name'           => 'required|string|max:255',
            'age'                 => 'required|integer|min:10|max:100',
            'email'               => 'required|email|unique:applications,email,NULL,id,webinar_id,' . $request->webinar_id,
            'phone'               => 'required|string',
            'country'             => 'required|string',
            'city'                => 'required|string',
            'registering_as'      => 'required|in:student,professional',

            'company_name'        => 'required_if:registering_as,professional|string|nullable',
            'designation'         => 'required_if:registering_as,professional|string|nullable',
            'years_of_experience' => 'required_if:registering_as,professional|integer|nullable',
            'industry'            => 'nullable|string',
            'linkedin_profile'    => 'nullable|url',

            'current_class'       => 'required_if:registering_as,student|string|nullable',
            'school_college'      => 'required_if:registering_as,student|string|nullable',

            'career_aspiration'   => 'required|string',
            'reason_for_joining'  => 'required|string',

            // 'father_name'         => 'required|string|max:255',
            // 'father_occupation'   => 'nullable|string|max:255',
            // 'father_phone'        => 'nullable|string',
            // 'father_email'        => 'nullable|email',

            // 'mother_name'         => 'required|string|max:255',
            // 'mother_occupation'   => 'nullable|string|max:255',
            // 'mother_phone'        => 'nullable|string',
            // 'mother_email'        => 'nullable|email',

            // Parent Details - Required only for Students
            'father_name'         => 'required_if:registering_as,student|nullable|string|max:255',
            'father_occupation'   => 'nullable|string|max:255',
            'father_phone'        => 'nullable|string',
            'father_email'        => 'nullable|email',

            'mother_name'         => 'required_if:registering_as,student|nullable|string|max:255',
            'mother_occupation'   => 'nullable|string|max:255',
            'mother_phone'        => 'nullable|string',
            'mother_email'        => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $webinar = Webinar::findOrFail($request->webinar_id);

        $totalApplications = Application::where('webinar_id', $request->webinar_id)->count();

        // dd($webinar->restricted_application);

        if ($totalApplications >= $webinar->restricted_application) {
            return response()->json([
                'success' => false,
                'message' => 'Registration is closed. The maximum number of applications has been reached.',
            ], 422);
        }

        $application = Application::create([
             ...$request->all(),
            'added_by' => auth()->id(),
            'status'   => 'pending',
        ]);

        // ================ SEND EMAIL HERE ================
        try {
            Mail::to($application->email)->send(new ApplicationSubmitted($application));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
        // ================================================

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully! A confirmation email has been sent.',
            'data'    => $application,
        ], 201);
    }

    public function getByDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid date in Y-m-d format',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $webinars = Webinar::with('applications')
            ->whereDate('date', $request->date)
            ->orderBy('start_time')
            ->get();

        $webinars->transform(function ($webinar) {

            $totalApplications = $webinar->applications->count();

            $remainingSeats = max(
                0,
                $webinar->restricted_application - $totalApplications
            );

            // $webinar->registered_count = $totalApplications;
            $webinar->remaining_seats = $remainingSeats;

            return $webinar;
        });

        return response()->json([
            'success' => true,
            'date'    => $request->date,
            'count'   => $webinars->count(),
            'data'    => $webinars,
        ]);
    }

    /**
     * Apporvel for application
     */

    public function approve($id)
    {
        $application = Application::with('webinar')->findOrFail($id);

        $application->update([
            'status' => 'approved',
        ]);

        // Get meeting link from webinar table
        $meetingLink = $application->webinar->meeting_link;
        // dd($meetingLink);

        Mail::to($application->email)->send(
            new WebinarApprovalMail(
                $application,
                $application->webinar,
                $meetingLink
            )
        );

        return response()->json([
            'success' => true,
            'message' => 'Application approved and email sent successfully.',
        ]);
    }

    /**
     * Rejected for application
     */

    public function reject(Request $request, $id)
    {

        $application = Application::find($id);

        if (! $application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.',
            ], 404);
        }

        if ($application->status == 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'Application already rejected.',
            ], 400);
        }

        $application->update([
            'status' => 'rejected',
            // 'remarks' => $request->remarks,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application rejected successfully.',
            'data'    => $application,
        ]);
    }
}