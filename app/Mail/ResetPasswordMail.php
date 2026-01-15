<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $email, public $password) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no_reply@sil83.com', 'NO_REPLY'),
            subject: 'Credenciales de acceso a plataforma sil83.com',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
