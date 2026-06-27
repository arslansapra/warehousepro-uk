<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use App\Notifications\LowStockNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

use App\Models\User;

class SendLowStockNotification
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
    public function handle(LowStockDetected $event): void
    {
        // dd('LISTENER WORKING', $event->product);
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new LowStockNotification($event->product)
            );
        }
    }
}
