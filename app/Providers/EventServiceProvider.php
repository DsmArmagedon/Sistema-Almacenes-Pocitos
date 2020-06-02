<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        'App\Events\DetailPurchaseCreatedUpdatedDeleted' => [
            'App\Listeners\UpdateQuantityStockProductPurchase',
        ],
        'App\Events\DetailSaleCreatedUpdatedDeleted' => [
            'App\Listeners\UpdateQuantityStockProductSale',
        ],
        'App\Events\InputOutputCreatedUpdatedDeleted' => [
            'App\Listeners\UpdateQuantityStockProduct',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
