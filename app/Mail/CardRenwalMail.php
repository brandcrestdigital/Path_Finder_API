<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CardRenwalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $card;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $card)
    {
        $this->user = $user;
        $this->card = $card;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject("Don't Pause Your Digital Presence")
            ->view('emails.card-reactivated');
    }

    /**
     * Get the message content definition.
     */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
