<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionCancelled
{
    use Queueable;

    protected $property_name;
    protected $auctionID;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($property_name, $auctionID)
    {
        $this->property_name = $property_name;
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
            ->line('Se ha cancelado una subasta de la propiedad ' .$this->property_name. '. Lo sentimos!')
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