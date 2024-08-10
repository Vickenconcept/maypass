<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class SpacePurchasedNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;

       
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification for storage in the database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your payment was successfully processed for ' . $this->data['space_name'],
            'amount' => $this->data['total_amount'],
            'name' => $this->data['name'],
            'url' => '/my-spaces',
        ];
    }
}
