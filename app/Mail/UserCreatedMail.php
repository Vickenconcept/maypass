<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $password;

    public function __construct( $name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    // public function build()
    // {
    //     return $this->view('emails.user_created')
    //                 ->with(['user' => $this->user]);
    // }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'User Created Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */


    public function content(): Content
    {
        return new Content(
            view: 'emails.user_created',
            with: [
                'user' => $this->name,
                'password' => $this->password,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
