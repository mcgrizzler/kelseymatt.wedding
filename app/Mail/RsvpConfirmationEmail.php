<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invite $invite) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RSVP Received — '.config('wedding.partner_one').' & '.config('wedding.partner_two').'\'s Wedding',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rsvp-confirmation',
            with: [
                'editUrl' => url('/rsvp/'.$this->invite->token),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
