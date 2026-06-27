<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Events\LowStockDetected;
use App\Listeners\SendLowStockNotification;

use App\Events\PurchaseOrderCreated;
use App\Listeners\SendPurchaseOrderCreatedNotification;

use App\Events\PurchaseOrderApproved;
use App\Listeners\SendPurchaseOrderApprovedNotification;

use App\Events\PurchaseOrderReceived;
use App\Listeners\SendPurchaseOrderReceivedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        LowStockDetected::class => [
            SendLowStockNotification::class,
        ],
        PurchaseOrderCreated::class => [
            SendPurchaseOrderCreatedNotification::class,
        ],

        PurchaseOrderApproved::class => [
            SendPurchaseOrderApprovedNotification::class,
        ],

        PurchaseOrderReceived::class => [
            SendPurchaseOrderReceivedNotification::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
