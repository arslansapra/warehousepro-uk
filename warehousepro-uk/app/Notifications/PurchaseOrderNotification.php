<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderNotification extends Notification
{
    use Queueable;

    public function __construct(
        public $purchaseOrder,
        public $type
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Purchase Order Notification')
            ->line($this->getMessage())
            ->line('PO Number: ' . $this->purchaseOrder->po_number);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type,
            'po_id' => $this->purchaseOrder->id,
            'po_number' => $this->purchaseOrder->po_number,
            'message' => $this->getMessage(),
        ];
    }

    private function getMessage(): string
    {
        return match ($this->type) {
            'created' => 'New Purchase Order created: ' . $this->purchaseOrder->po_number,
            'approved' => 'Purchase Order approved: ' . $this->purchaseOrder->po_number,
            'received' => 'Stock received from PO: ' . $this->purchaseOrder->po_number,
            default => 'Purchase Order update',
        };
    }
}
