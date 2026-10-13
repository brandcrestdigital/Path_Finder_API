<?php
namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;
    public bool $isAdminCopy;

    public function __construct(Ticket $ticket, bool $isAdminCopy = false)
    {
        $this->ticket      = $ticket;
        $this->isAdminCopy = $isAdminCopy;
    }

    public function envelope(): Envelope
    {
        $prefix = $this->isAdminCopy ? '[NEW TICKET] ' : '';
        return new Envelope(
            subject: $prefix . 'Ticket #' . $this->ticket->ticket_no . ' - ' . $this->ticket->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket-created', // Pure HTML
        );
    }
}
