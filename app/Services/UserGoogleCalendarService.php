<?php

namespace App\Services;

use App\Models\User;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\ConferenceData;
use Google\Service\Calendar\CreateConferenceRequest;
use Google\Service\Calendar\ConferenceSolutionKey;
use Illuminate\Support\Facades\Log;

class UserGoogleCalendarService
{
    protected GoogleClient $client;
    protected Calendar $calendarService;
    protected string $calendarId;
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->client = new GoogleClient();

        $this->client->setApplicationName(
            'Hamsini Silks - User Meeting Calendar'
        );

        $this->client->setScopes([
            Calendar::CALENDAR,
            Calendar::CALENDAR_EVENTS,
        ]);

        // Use OAuth credentials from config/services.php
        $this->client->setClientId(
            config('services.google.client_id')
        );

        $this->client->setClientSecret(
            config('services.google.client_secret')
        );

        // Set the user's stored access token with refresh token support
        // NOTE: Google API Client v2.19.3 requires refresh_token to be part of
        // the token array passed to setAccessToken(); there is no setRefreshToken() method.
        $tokenData = [
            'access_token' => $user->google_token,
        ];
        if ($user->google_refresh_token) {
            $tokenData['refresh_token'] = $user->google_refresh_token;
        }
        $this->client->setAccessToken($tokenData);

        // IMPORTANT: Enable automatic token refresh
        $this->client->setAccessType('offline');

        // If token is expired and we have a refresh token, refresh it
        if ($this->client->isAccessTokenExpired() && $user->google_refresh_token) {
            try {
                // fetchAccessTokenWithRefreshToken() already calls setAccessToken() internally
                // with the full refreshed credentials array (including refresh_token)
                $newToken = $this->client->fetchAccessTokenWithRefreshToken(
                    $user->google_refresh_token
                );

                if (!empty($newToken['access_token'])) {
                    // Update the user's stored token with the new one
                    $user->google_token = $newToken['access_token'];

                    // If a new refresh token was returned (rare but possible), store it too
                    if (!empty($newToken['refresh_token'])) {
                        $user->google_refresh_token = $newToken['refresh_token'];
                    }

                    $user->save();

                    // Token is already set by fetchAccessTokenWithRefreshToken() internally,
                    // so no need to call setAccessToken() again here.
                }
            } catch (\Exception $e) {
                Log::error('Failed to refresh Google token for user #' . $user->id . ': ' . $e->getMessage());
                throw $e;
            }
        }

        $this->calendarService = new Calendar($this->client);

        // Use the user's primary calendar
        $this->calendarId = 'primary';
    }

    /**
     * Create Google Calendar Event with REAL Google Meet
     * Uses the employee's own calendar (primary).
     */
    public function createEvent(array $data): ?array
    {
        try {
            // ================= EVENT =================

            $event = new Event();

            $event->setSummary(
                $data['summary'] ?? 'Meeting'
            );

            $event->setDescription(
                $data['description'] ?? ''
            );

            // ================= START =================

            $start = new EventDateTime();

            $start->setDateTime(
                $data['startDateTime']
            );

            $start->setTimeZone(
                $data['timezone'] ?? 'Asia/Kolkata'
            );

            $event->setStart($start);

            // ================= END =================

            $end = new EventDateTime();

            $end->setDateTime(
                $data['endDateTime']
            );

            $end->setTimeZone(
                $data['timezone'] ?? 'Asia/Kolkata'
            );

            $event->setEnd($end);

            // ================= GOOGLE MEET =================

            $conferenceData = new ConferenceData();

            $conferenceSolutionKey =
                new ConferenceSolutionKey();

            $conferenceSolutionKey->setType(
                'hangoutsMeet',
            );

            $createConferenceRequest =
                new CreateConferenceRequest();

            $createConferenceRequest->setRequestId(
                'meet-' . uniqid()
            );

            $createConferenceRequest
                ->setConferenceSolutionKey(
                    $conferenceSolutionKey
                );

            $conferenceData->setCreateRequest(
                $createConferenceRequest
            );

            $event->setConferenceData(
                $conferenceData
            );

            // ================= VISIBILITY =================

            $event->setVisibility('default');

            $event->setTransparency('opaque');

            // ================= CREATE EVENT =================

            $createdEvent =
                $this->calendarService
                    ->events
                    ->insert(
                        $this->calendarId,
                        $event,
                        [
                            'conferenceDataVersion' => 1,
                        ]
                    );

            // ================= GET REAL MEET LINK =================

            $hangoutLink = null;

            // METHOD 1: direct hangout link
            if ($createdEvent->getHangoutLink()) {
                $hangoutLink =
                    $createdEvent->getHangoutLink();
            }

            // METHOD 2: from conference data entry points
            if (
                ! $hangoutLink &&
                $createdEvent->getConferenceData()
            ) {
                $conference =
                    $createdEvent->getConferenceData();

                if ($conference->getEntryPoints()) {
                    foreach (
                        $conference->getEntryPoints()
                        as $entryPoint
                    ) {
                        if (
                            $entryPoint->getEntryPointType()
                            === 'video'
                        ) {
                            $hangoutLink =
                                $entryPoint->getUri();
                            break;
                        }
                    }
                }
            }

            return [
                // 'id' => $createdEvent->getId(),
                // 'hangoutLink' => $hangoutLink,
                // 'conferenceData' =>
                //     $createdEvent->getConferenceData(),

                  'id' => $createdEvent->getId(),
    'htmlLink' => $createdEvent->getHtmlLink(),
    'hangoutLink' => $hangoutLink,
    'conferenceData' => $createdEvent->getConferenceData(),
            ];


            \Log::info('Calendar Event', [
    'id' => $result['id'] ?? null,
    'htmlLink' => $result['htmlLink'] ?? null,
    'hangoutLink' => $result['hangoutLink'] ?? null,
]);
        } catch (\Exception $e) {
            Log::error(
                'User Google Calendar API error: ' .
                $e->getMessage(),
                [
                    'user_id' => $this->user->id,
                    'trace'   => $e->getTraceAsString(),
                ]
            );
            throw $e;
        }
    }

    /**
     * Get Event
     */
    public function getEvent(string $eventId): ?Event
    {
        try {
            return $this->calendarService
                ->events
                ->get(
                    $this->calendarId,
                    $eventId
                );
        } catch (\Exception $e) {
            Log::error(
                'User Google Calendar get error: ' .
                $e->getMessage()
            );
            return null;
        }
    }

    /**
     * Update Event
     */
    public function updateEvent(
        string $eventId,
        array $data
    ): bool {
        try {
            $event = $this->calendarService
                ->events
                ->get(
                    $this->calendarId,
                    $eventId
                );

            if (isset($data['summary'])) {
                $event->setSummary($data['summary']);
            }

            if (isset($data['description'])) {
                $event->setDescription($data['description']);
            }

            if (isset($data['startDateTime'])) {
                $start = new EventDateTime();
                $start->setDateTime($data['startDateTime']);
                $start->setTimeZone(
                    $data['timezone'] ?? 'Asia/Kolkata'
                );
                $event->setStart($start);
            }

            if (isset($data['endDateTime'])) {
                $end = new EventDateTime();
                $end->setDateTime($data['endDateTime']);
                $end->setTimeZone(
                    $data['timezone'] ?? 'Asia/Kolkata'
                );
                $event->setEnd($end);
            }

            $this->calendarService
                ->events
                ->update(
                    $this->calendarId,
                    $eventId,
                    $event
                );

            return true;
        } catch (\Exception $e) {
            Log::error(
                'User Google Calendar update error: ' .
                $e->getMessage()
            );
            return false;
        }
    }

    /**
     * Delete Event
     */
    public function deleteEvent(
        string $eventId
    ): bool {
        try {
            $this->calendarService
                ->events
                ->delete(
                    $this->calendarId,
                    $eventId
                );

            return true;
        } catch (\Exception $e) {
            Log::error(
                'User Google Calendar delete error: ' .
                $e->getMessage()
            );
            return false;
        }
    }
}