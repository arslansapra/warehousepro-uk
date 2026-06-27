<?php

namespace App\Listeners;

use App\Events\PurchaseOrderApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\PurchaseOrderNotification;

class SendPurchadeOrderApprovedNotification
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
    public function handle(PurchaseOrderApproved $event): void
    {
        //dd('Purchase Order Approved Listener Fired');
        $staff = User::where('role_id', '3')->get();

        foreach ($staff as $user) {
            $user->notify(
                new PurchaseOrderNotification($event->purchaseOrder, 'approved')
            );
        }
    }
}
