<?php
namespace App\Mail;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Meeting $meeting;
    // public string $meetLink;
    public ?string $meetLink;

    /**
     * Create a new message instance.
     */
    public function __construct(Meeting $meeting, ?string $meetLink = null)
    {
        $this->meeting  = $meeting;
        $this->meetLink = $meetLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                'meeting@miprofile.in',
                'MI Profile Meetings'
            ),
            subject: 'Meeting Confirmed – ' . $this->meeting->title,
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.meeting-confirmation',
    //         with: [
    //             'meeting' => $this->meeting,
    //             'meetLink' => $this->meetLink,
    //         ],
    //     );
    // }

    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting-confirmation',
            with: [
                'meeting'         => $this->meeting,
                'meetLink'        => $this->meetLink,
                'hostName'        => $this->meeting->user->name ?? 'Host',
                'calendarLink'    => $this->meetLink,
                'rescheduleLink'  => env('FRONTEND_URL') . '/meeting/reschedule/' . $this->meeting->id,
                'cancelLink'      => env('REACT_APP_URL').'/cancel-meeting/'.$this->meeting->google_event_id,
                'hostProfileLink' => env('FRONTEND_URL') . ' / profile / ' . ($this->meeting->user->user_slug ?? ''),
            ]
        );
    }
    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn() => $this->generateIcs(), 'meeting_' . $this->meeting->id . ' . ics')
                ->withMime('text / calendar'),
        ];
    }

    /**
     * Generate an ICS calendar file content
     */
    private function generateIcs(): string
    {
        $meeting = $this->meeting;

        // Convert meeting_time (e.g. "1PM" or "2:30PM") to H:i:s format
        $time = date('H: i: s', strtotime($meeting->meeting_time));
        $date = $meeting->meeting_date;

        $dtStart = date('Ymd\THis ', strtotime("$date $time"));
        $dtEnd   = date('Ymd\THis ', strtotime("$date $time + 1 hour"));

        $uid = 'meeting-' . $meeting->id . '@hamsinisilks . com';

        $lines = [
            'BEGIN: VCALENDAR',
            'VERSION: 2.0',
            'PRODID: -//Hamsini Silks//Meeting Calendar//EN',
            'METHOD:REQUEST',
            'BEGIN:VEVENT',
            'UID:' . $uid,
            'DTSTART:' . $dtStart,
            'DTEND:' . $dtEnd,
            'SUMMARY:' . $this->escapeIcs($meeting->title),
            'DESCRIPTION:' . $this->escapeIcs($meeting->description ?? 'No description'),
            'LOCATION:Google Meet - ' . $this->meetLink,
            'ORGANIZER;CN=Hamsini Silks:mailto:info@hamsinisilks.com',
            'ATTENDEE;CN=' . $this->escapeIcs($meeting->requester_name) . ':mailto:' . $meeting->requester_email,
            'STATUS:CONFIRMED',
            'BEGIN:VALARM',
            'TRIGGER:-PT15M',
            'ACTION:DISPLAY',
            'DESCRIPTION:Reminder: Meeting in 15 minutes',
            'END:VALARM',
            'END:VEVENT',
            'END:VCALENDAR',
        ];

        return implode("\r\n", $lines);
    }

    private function escapeIcs(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return str_replace([',', ';', "\n", "\r"], ['\,', '\;', '\\n', ''], $value);
    }
}