<?php
namespace App\Mail;

use App\Models\StaffCard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffCardUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public StaffCard $card;

    /**
     * Create a new message instance.
     */
    public function __construct(StaffCard $card)
    {
        $this->card = $card;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Staff Card Has Been Successfully Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.staff-card-updated',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
