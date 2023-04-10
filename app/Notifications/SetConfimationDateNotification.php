<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetConfimationDateNotification extends Notification
{
    use Queueable;
    private $date;
    private $reclamtion_id;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($date, $reclamtion_id)
    {
        $this->date = $date;
        $this->reclamtion_id = $reclamtion_id;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message3' => 'you recived a date for reclamtion ',
            'date_id' => $this->date->date_id,
            'reclamtion_id' => $this->reclamtion_id,
            'confirmation_date' => $this->date->date,
        ];

    }
}
