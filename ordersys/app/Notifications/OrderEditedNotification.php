<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderEditedNotification extends Notification
{
    use Queueable;
    protected $email;
    protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $url_prefix)
    {
        $this->order =$order;
        $this->url_prefix = $url_prefix;
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
       ->subject('ORDER EDITED')
       ->line('Order - '.$this->order->order_code.' has been edited.')
       ->action('Follow this url to view on the order:', url($this->url_prefix.'/order/'.$this->order->order_code))
       ->line('Thank you for choosing Eddusaver.');
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
