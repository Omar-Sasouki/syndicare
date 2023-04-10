<?php

namespace App\Notifications;

use App\Models\Residence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TableUpdatedNotification extends Notification
{
    use Queueable;

 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        
      
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message1' =>'A new event has been set ', 
           
        ];
    }
}