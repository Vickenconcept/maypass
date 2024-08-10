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
    public $email;

    public function __construct($name, $password,$email)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user_created',
            with: [
                'name' => $this->name,
                'password' => $this->password,
                'email' => $this->email,
            ],
        );
    }
}
