<?php

namespace App\Notifications;

use App\Order;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotifyClient extends Notification
{
    use Queueable;

    /**
     * @var Order
     */
    private $order;
    /**
     * @var Product
     */
    private $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, Collection $product)
    {
        //
        $this->order = $order;
        $this->product = $product;
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
                    ->markdown('vendor.mail.html.message', ['products' => $this->product, 'order'=>$this->order]);
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
