<?php
namespace App\Mail;

use App\Models\Application;
use App\Models\Webinar;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WebinarApprovalMail extends Mailable
{
    public $application;
    public $webinar;
    public $meetingLink;

    public function __construct($application, $webinar, $meetingLink)
    {
        $this->application = $application;
        $this->webinar     = $webinar;
        $this->meetingLink = $meetingLink;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Webinar Approved'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.webinar_approval',
        );
    }
}