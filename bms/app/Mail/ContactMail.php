<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subjectLine;
    public $messageText;

    /**
     * Pass contact form data into the mail class.
     */
    public function __construct($name, $email, $subjectLine, $messageText)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subjectLine = $subjectLine;
        $this->messageText = $messageText;
    }

    /**
     * Set email header details.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
            from: $this->email
        );
    }

    /**
     * Pass content to Blade/Markdown view.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subjectLine' => $this->subjectLine,
                'messageText' => $this->messageText,
            ]
        );
    }

    /**
     * Attachments if needed later.
     */
    public function attachments(): array
    {
        return [];
    }
}
