<?php

namespace App\Services\Orders;

use App\Services\Orders\Listeners\CancelOrderListener;
use App\Services\Orders\Listeners\CompleteOrderListener;
use App\Services\Orders\Models\Order;
use App\Services\Payments\Events\PaymentCancelledEvent;
use App\Services\Payments\Events\PaymentCompletedEvent;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use LaravelLang\Publisher\Console\Reset;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        Relation::enforceMorphMap([
            "order"=> Order::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        Event::listen(PaymentCompletedEvent::class, CompleteOrderListener::class);
        Event::listen(PaymentCancelledEvent::class, CancelOrderListener::class);
    }
}
