<?php

namespace App\Listeners;

use App\Events\PurchaseOrderReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\PurchaseOrderNotification;

class SendPurchadeOrderReceivedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PurchaseOrderReceived $event): void
    {
        $admins = User::where('role_id', '1')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new PurchaseOrderNotification($event->purchaseOrder, 'received')
            );
        }
    }
}
