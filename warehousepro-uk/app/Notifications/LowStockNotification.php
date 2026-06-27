<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $product)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        //dd("Low Stock Notificatios WORKING");
        return (new MailMessage)
            ->subject('Low Stock Alert')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A product has reached the low stock threshold.')
            ->line('Product: ' . $this->product->name)
            ->line('Current Quantity: ' . $this->product->quantity)
            ->line('Please restock this item as soon as possible.')
            ->salutation('WarehousePro UK');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'quantity' => $this->product->quantity,
            'message' => "Low stock alert: {$this->product->name} has only {$this->product->quantity} items remaining.",
        ];
    }
}
