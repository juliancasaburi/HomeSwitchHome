<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookedByAPremiumUser extends Notification implements ShouldQueue
{
    use Queueable;

    protected $propertyName;
    protected $date;
    protected $weekID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($propertyName, $date, $weekID)
    {
        $this->propertyName = $propertyName;
        $this->date = $date;
        $this->weekID = $weekID;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url("/week?id=" . $this->weekID);

        return (new MailMessage)
            ->subject('HSH | Una subasta inscripta ha sido obtenida por un Premium')
            ->greeting('Hola, ' . $notifiable->nombre)
            ->line('Un usuario Premium se ha adjudicado una semana en la que estabas inscripto')
            ->line('Propiedad: ' .$this->propertyName)
            ->line('Semana: ' .$this->date)
            ->action('Ver Semana', $link)
            ->salutation('Home Switch Home - Cadena de Residencias');
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
            //
        ];
    }
}