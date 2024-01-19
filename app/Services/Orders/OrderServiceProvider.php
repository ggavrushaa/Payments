<?php

namespace App\Services\Orders;

use App\Services\Orders\Models\Order;
use Illuminate\Database\Eloquent\Relations\Relation;
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
    }
}
