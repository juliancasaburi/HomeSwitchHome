<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionCancelled extends Notification
{
    use Queueable;

    protected $propertyName;
    protected $auctionID;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($propertyName, $auctionID)
    {
        $this->propertyName = $propertyName;
        $this->auctionID = $auctionID;
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
            ->subject('HSH | Una subasta se ha cancelado')
            ->greeting('Hola, ' . $notifiable->nombre)
            ->line('Se ha cancelado una subasta de la propiedad ' .$this->propertyName. '. Lo sentimos!')
            ->action('Ver Subasta', $link)
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