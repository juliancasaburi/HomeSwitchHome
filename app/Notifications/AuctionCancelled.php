<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionCancelled extends Notification
{
    use Queueable;

    protected $propertyName;
    protected $date;
    protected $auctionID;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($propertyName, $date, $auctionID)
    {
        $this->propertyName = $propertyName;
        $this->auctionID = $auctionID;
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
        $link = url( "/auction?id=" . $this->auctionID );

        return (new MailMessage)
            ->subject('HSH | Una subasta inscripta ha sido cancelada')
            ->greeting('Hola, ' . $notifiable->nombre)
            ->line('Hemos cancelado una subasta en la que estabas inscripto y aún no había comenzado')
            ->line('Propiedad: ' .$this->propertyName)
            ->line('Semana: ' .$this->date)
            ->action('Ver Subasta', $link)
            ->line('Lo sentimos.')
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