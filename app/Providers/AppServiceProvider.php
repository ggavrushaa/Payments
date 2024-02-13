<?php

namespace App\Providers;

use App\Adapters\CurrencyPaymentConverter;
use App\Services\Payments\Contracts\PaymentConverter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentConverter::class, CurrencyPaymentConverter::class);
    }

    public function boot(): void
    {
        bcscale(8);
        // DB::listen(function (QueryExecuted $query) {
        //     info ($query->sql);
        //     // $query->bindings;
        //     // $query->time;
        // });
    }
}
