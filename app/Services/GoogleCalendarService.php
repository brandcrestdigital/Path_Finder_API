<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\ConferenceData;
use Google\Service\Calendar\CreateConferenceRequest;
use Google\Service\Calendar\ConferenceSolutionKey;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    protected GoogleClient $client;
    protected Calendar $calendarService;
    protected string $calendarId;

    public function __construct()
    {
        $this->client = new GoogleClient();

        $this->client->setApplicationName(
            'Hamsini Silks - Meeting Calendar'
        );

        $this->client->setScopes([
            Calendar::CALENDAR,
        ]);

        $this->client->setAuthConfig(
            storage_path(
                'app/google-calendar/service-account.json'
            )
        );

        $this->client->setAccessType('offline');

        $this->calendarService = new Calendar(
            $this->client
        );

        // IMPORTANT
        // Use your Gmail calendar ID
        $this->calendarId = 'sk.asif0490@gmail.com';
    }

    /**
     * Create Google Calendar Event with REAL Google Meet
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

            // IMPORTANT
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

            // METHOD 1
            if ($createdEvent->getHangoutLink()) {

                $hangoutLink =
                    $createdEvent->getHangoutLink();
            }

            // METHOD 2
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
                'id' => $createdEvent->getId(),

                'hangoutLink' => $hangoutLink,

                'conferenceData' =>
                    $createdEvent->getConferenceData(),
            ];

        } catch (\Exception $e) {

             Log::error(
        'Google Calendar API error: ' .
        $e->getMessage(),
        [
            'trace' => $e->getTraceAsString(),
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
                'Google Calendar get error: ' .
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
    ): bool
    {
        try {

            $event = $this->calendarService
                ->events
                ->get(
                    $this->calendarId,
                    $eventId
                );

            if (isset($data['summary'])) {

                $event->setSummary(
                    $data['summary']
                );
            }

            if (isset($data['description'])) {

                $event->setDescription(
                    $data['description']
                );
            }

            if (isset($data['startDateTime'])) {

                $start = new EventDateTime();

                $start->setDateTime(
                    $data['startDateTime']
                );

                $start->setTimeZone(
                    $data['timezone']
                        ?? 'Asia/Kolkata'
                );

                $event->setStart($start);
            }

            if (isset($data['endDateTime'])) {

                $end = new EventDateTime();

                $end->setDateTime(
                    $data['endDateTime']
                );

                $end->setTimeZone(
                    $data['timezone']
                        ?? 'Asia/Kolkata'
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
                'Google Calendar update error: ' .
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
    ): bool
    {
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
                'Google Calendar delete error: ' .
                $e->getMessage()
            );

            return false;
        }
    }
}
