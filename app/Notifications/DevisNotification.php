<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DevisNotification extends Notification
{
    use Queueable;
    private $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    public function toArray($notifiable)
    {
        return [
            'message5' =>   ' We are pleased to inform you that you recived a new Devis',
            'code'=> 504,
            'typedevisnotification' => $this->type
        ];
    }
}
