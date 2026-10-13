<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;
    protected $pdf;
    protected $pdfPath;

    protected $invoice_no;

    public function __construct($purchase, $pdfPath, $invoiceNo)
    {
        $this->purchase   = $purchase;
        $this->pdfPath    = $pdfPath;
        $this->invoice_no = $invoiceNo;
    }

    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Invoice - ORD-' . $this->purchase->id,
    //     );
    // }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                'accounts@miprofile.in',
                'MI Profile Accounts'
            ),
            subject: 'Invoice'
        );
    }

    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.invoice',
    //         with: [
    //             'purchase'  => $this->purchase,
    //             'invoiceNo' => $this->invoice_no,
    //         ],
    //     );
    // }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice_mail',
            with: [
                'purchase'     => $this->purchase,
                'invoiceNo'    => $this->invoice_no,
                'downloadUrl'  => asset('storage/' . $this->pdfPath),
                'paymentLink'  => '',
                'supportEmail' => 'support@miprofile.in',
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk(
                'public',
                $this->pdfPath
            )->as(
                'invoice-ORD-' . $this->purchase->id . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
