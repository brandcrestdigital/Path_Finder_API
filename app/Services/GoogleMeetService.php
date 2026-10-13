<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use App\Models\Webinar;
use Carbon\Carbon;
use Exception;

class GoogleMeetService
{
    /**
     * Create Official Google Meet Link
     */
    public function createMeetLink(Webinar $webinar): string
    {
        $user = auth()->user();

        if (!$user || !$user->google_token) {
            throw new Exception('Please login with Google account to generate Meet link.');
        }

        $client = new Google_Client();
        $client->setAccessToken($user->google_token);

        // Refresh token if expired
        if ($client->isAccessTokenExpired() && $user->google_refresh_token) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
            
            $user->update([
                'google_token'            => $newToken['access_token'],
                'google_token_expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
            ]);
        }

        $service = new Google_Service_Calendar($client);

        $startTime = Carbon::parse($webinar->date . ' ' . $webinar->start_time);
        $endTime   = Carbon::parse($webinar->date . ' ' . $webinar->end_time);

        $event = new Google_Service_Calendar_Event([
            'summary'     => $webinar->title,
            'description' => $webinar->description ?? 'Webinar by ' . $user->name,
            'start'       => [
                'dateTime' => $startTime->toIso8601String(),
                'timeZone' => config('app.timezone'),
            ],
            'end'         => [
                'dateTime' => $endTime->toIso8601String(),
                'timeZone' => config('app.timezone'),
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => 'webinar_' . uniqid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        $event = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

        return $event->getHangoutLink();
    }
}