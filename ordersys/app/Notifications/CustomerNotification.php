<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Models\Order;

class CustomerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $client)
    {
        $this->order =$order;
        $this->client =$client;
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
        ->subject('ORDER RECEIVED')
        ->line('Hello dear '.$this->client->name.', we would like to thank you for placing your custom paper order with eddusaver')
        ->line('We have reserved a writer to work on your paper once you complete the ordering process, by login into your account and paying for the order.')
        ->line('The cost for the order is - $'.$this->order->order_price)
        ->line('Once we receive your payment we will email you a confirmation and assign the order to a writer based on your selection to ensure its delivered within the requested time. If you have any questions, you may email us at:support@eddusaver.com')
        ->action('Follow this url to view on the order:', url('customer/order/'.$this->order->order_code))
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

    public function toDatabase($notifiable)
    {
        return [
            'user'=>$notifiable,
            'order' => $this->order
        ];
    }
}
