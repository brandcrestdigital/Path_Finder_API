<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Schedule Update: Meeting Cancelled',
        );
    }

    public function content(): Content
    {
        $this->meeting->loadMissing([
            'user.staffCard',
            'user.organization',
        ]);

        $staffSlug = $this->meeting->user?->staffCard?->slug;
        $orgSlug   = $this->meeting->user?->organization?->slug;

        $hostProfileLink = '#';

        if ($staffSlug && $orgSlug) {
            $hostProfileLink = sprintf(
                '%s/%s/%s',
                env('REACT_APP_URL'),
                $orgSlug,
                $staffSlug
            );
        }

        return new Content(
            view: 'emails.meeting_cancelled',
            with: [
                'meeting'         => $this->meeting,
                'hostName'        => $this->meeting->user->name ?? 'Host',
                'hostProfileLink' => $hostProfileLink,
                'supportEmail'    => 'support@miprofile.in',
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
