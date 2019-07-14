<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class HotsaleReservationObtained extends Notification implements ShouldQueue
{
    use Queueable;

    protected $property_name;
    protected $date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($property_name, $date)
    {
        $this->property_name = $property_name;
        $this->date = $date;
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

        return (new MailMessage)
            ->subject('HSH | Reserva hotsale obtenida')
            ->greeting('Hola, ' . $notifiable->nombre)
            ->line('Has obtenido la reserva hotsale de la propiedad ' .$this->property_name. ' para la semana ' .$this->date)
            ->line('Gracias por utilizar nuestra aplicación!')
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