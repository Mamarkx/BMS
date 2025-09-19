<?php

namespace App\Mail;

use App\Models\Cedula;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CedulaReleased extends Mailable
{
    use Queueable, SerializesModels;
    public $document;
    public $greeting;
    public $claim_date;
    /**
     * Create a new message instance.
     */
    public function __construct(Cedula $document, string $greeting, string $claim_date)
    {
        $this->document = $document;
        $this->greeting = $greeting;
        $this->claim_date = $claim_date;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your ' . $this->document->type . ' is Now Available!',
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.document_released',
        );
    }

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
