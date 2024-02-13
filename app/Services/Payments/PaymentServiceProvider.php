<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Services\Payments\Commands\InstallPaymentsCommand;
use App\Services\Bitcoin\Events\BitcoinTransactionCompleted;
use App\Services\Payments\Listeners\CompletePaymentListener;

class PaymentServiceProvider extends ServiceProvider
{
  
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ ."/Views", "payments");
        
        $this->publishes([
            __DIR__ ."/Views" => resource_path('views/vendor/payments'),
        ], 'payments');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ .'/Migrations');

            $this->commands([
                InstallPaymentsCommand::class, 
                ]);
        }

        Event::listen(BitcoinTransactionCompleted::class, CompletePaymentListener::class);
    }
}