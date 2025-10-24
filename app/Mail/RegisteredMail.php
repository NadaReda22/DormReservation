<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎓 Registration Confirmed — Room Selection Instructions',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.register',
            with: [
                'student_id' => $this->student->student_id,
            ],
        );
    }

    public function attachments(): array
    {
       return [
        Attachment::fromPath(storage_path('/app/public/image.jpg'))
            ->as('logo.jpg')
            ->withMime('image/jpg'),
    ];
    }
}
