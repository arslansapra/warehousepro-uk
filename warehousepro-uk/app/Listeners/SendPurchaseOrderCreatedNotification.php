<?php

namespace App\Listeners;

use App\Events\PurchaseOrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\PurchaseOrderNotification;

class SendPurchaseOrderCreatedNotification
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
    public function handle(PurchaseOrderCreated $event): void
    {
        //dd('listener fired');
        $managers = User::where('role_id', '2')->get();

        foreach ($managers as $manager) {
            $manager->notify(
                new PurchaseOrderNotification($event->purchaseOrder, 'created')
            );
        }  
    }
}
