<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VaccinationReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccination Reminder',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.vaccination-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
