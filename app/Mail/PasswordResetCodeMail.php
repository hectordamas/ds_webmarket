<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;


    public $code;
    public function __construct($code)
    {
        $this->code = $code;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu código para restablecer contraseña en' . env('APP_NAME'),
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.reset_code',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
