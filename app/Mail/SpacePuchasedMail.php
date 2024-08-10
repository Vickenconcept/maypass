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

class SpacePuchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    // public $password;

    public function __construct( $data)
    {
        $this->data = $data;
        
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
            view: 'emails.space_purchased',
            with: [
                'data' => $this->data,
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
