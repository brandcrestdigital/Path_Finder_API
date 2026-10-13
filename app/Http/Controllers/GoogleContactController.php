<?php
namespace App\Http\Controllers;

use App\Mail\MeetingConfirmationMail;
use App\Models\Meeting;
use App\Services\UserGoogleCalendarService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class GoogleContactController extends Controller
{

  
    
    
    
     public function save(Request $request)
    {

        $user = auth()->user();


          if ($request->meetingBooked) {

        $validator = Validator::make($request->all(), [
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'company'            => 'nullable|string|max:255',

            'meetingTitle'       => 'required|string|max:255',
            'meetingDescription' => 'nullable|string',
            'meetingDate'        => 'required|date|after_or_equal:today',
            'meetingTime'        => 'required|date_format:H:i',

            'meeting_type'        => 'required|in:online,offline',

            'location'           => 'required_if:meeting_type,offline|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }
    }

        $accessToken = $user->google_token;

        // ================= SAVE GOOGLE CONTACT =================

        $response = Http::withToken($accessToken)
            ->post(
                'https://people.googleapis.com/v1/people:createContact',
                [
                    'names'          => [
                        [
                            'givenName' => $request->name,
                        ],
                    ],

                    'phoneNumbers'   => array_filter([
                        $request->phone
                            ? ['value' => $request->phone]
                            : null,

                        $request->phone2
                            ? ['value' => $request->phone2]
                            : null,
                    ]),

                    'emailAddresses' => $request->email
                        ? [
                        [
                            'value' => $request->email,
                        ],
                    ]
                        : [],

                    'organizations'  => [
                        [
                            'name'  => $request->company,
                            'title' => $request->designation,
                        ],
                    ],

                    'urls'           => $request->website
                        ? [
                        [
                            'value' => $request->website,
                        ],
                    ]
                        : [],

                    'addresses'      => $request->address
                        ? [
                        [
                            'formattedValue' => $request->address,
                        ],
                    ]
                        : [],
                ]
            );

        // ================= CREATE MEETING =================

        $meeting = null;

        if (
            $response->successful() &&
            $request->meetingBooked
        ) {

            $meeting = Meeting::create([
                'user_id'         => $user->id,
                'requester_name'  => $request->name,
                'requester_email' => $request->email,
                'company_name'    => $request->company,
                'phone'           => $request->phone,
                'title'           => $request->meetingTitle,
                'description'     => $request->meetingDescription,
                'meeting_date'    => $request->meetingDate,
                'meeting_type'    => $request->meeting_type,
                'location'        => $request->meeting_type == 'offline'
                            ? $request->location
                            : null,
                'meeting_time'    => $request->meetingTime,
                'status'          => 'pending',
            ]);

            // ================= GOOGLE CALENDAR =================

            $calendarService = new UserGoogleCalendarService($user);

            $startDateTime = Carbon::parse(
                $request->meetingDate . ' ' . $request->meetingTime,
                'Asia/Kolkata'
            )->toIso8601String();

            $endDateTime = Carbon::parse(
                $request->meetingDate . ' ' . $request->meetingTime,
                'Asia/Kolkata'
            )->addHour()->toIso8601String();

            $event = $calendarService->createEvent([
                'summary'     => $request->meetingTitle,
                'description' =>
                ($request->meetingDescription ?? '') .
                "\n\nContact: {$request->name}" .
                "\nCompany: {$request->company}" .
                "\nEmail: {$request->email}" .
                "\nPhone: {$request->phone}",

                'startDateTime' => $startDateTime,
                'endDateTime'   => $endDateTime,
                'timezone'      => 'Asia/Kolkata',
            ]);

            \Log::info('Google Event Response', [
                'event' => $event,
            ]);

            $meeting->update([
                'google_event_id' => $event['id'] ?? null,
                'meet_link'       => $event['hangoutLink'] ?? null,
                'status'          => 'confirmed',
            ]);

            Mail::to($request->email)
                ->send(
                    new MeetingConfirmationMail(
                        $meeting,
                        $event['hangoutLink'] ?? ''
                    )
                );
        }

        $meetLink = '';

        if (isset($event['hangoutLink'])) {
            $meetLink = is_array($event['hangoutLink'])
                ? json_encode($event['hangoutLink'])
                : $event['hangoutLink'];
        }

        \Log::info('Meeting WhatsApp Debug', [
            'request_all'  => $request->all(),
            'user_name'    => $user->name ?? null,
            'user_phone'   => $user->phone ?? null,
            'meeting_id'   => $meeting->id ?? null,
            'meeting_date' => $request->meetingDate ?? null,
            'meeting_time' => $request->meetingTime ?? null,
            'company'      => $request->company ?? null,
            'phone'        => $request->phone ?? null,
            'event'        => $event ?? null,
            'cancel_link'  => $cancelLink ?? null,
        ]);

        try {

            $cancelLink = env('REACT_APP_URL') .
            '/cancel-meeting/' . $meeting->google_event_id;

            $messenger = app(\App\Services\Messenger360Service::class);

            // Invitee
            if (! empty($request->phone)) {

                $message = "Hi {$request->name} ✨

Your meeting is created.

It's now added inside Mi Profile and ready for the next step.

With: {$user->name}

Date: {$request->meetingDate}

Time: {$request->meetingTime}

Google Meet:
{$meetLink}

Need to cancel this meeting?

Cancel Meeting:
{$cancelLink}

Team Mi Profile";

                $messenger->send(
                    (string) $request->phone,
                    $message
                );
            }

            \Log::info('WhatsApp Message', [
                'phone'      => $request->phone,
                'message'    => $message,
                'cancelLink' => $cancelLink,
                'meetLink'   => $meetLink,
            ]);

            // Host/Card Holder
            if (! empty($user->phone)) {

                $hostMessage = "📅 New Meeting Scheduled

Hi {$user->name},

A meeting has been booked through Mi Profile.

Name: {$request->name}
Phone: {$request->phone}
Email: {$request->email}
Company: {$request->company}

Date: {$request->meetingDate}
Time: {$request->meetingTime}

Team Mi Profile";

                $messenger->send(
                    (string) $user->phone,
                    $hostMessage
                );
            }

        } catch (\Exception $e) {

            \Log::error('Meeting WhatsApp Failed', [
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'contact' => $response->json(),
            'meeting' => $meeting,
        ]);
    }
}
