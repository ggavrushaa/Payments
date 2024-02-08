<?php

namespace App\Services\Currencies;

use App\Services\Currencies\Commands\InstallCurrenciesCommand;
use App\Services\Currencies\Commands\UpdateCurrencyPricesCommand;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->commands([
            InstallCurrenciesCommand::class,
            UpdateCurrencyPricesCommand::class,
        ]);
    }
}
