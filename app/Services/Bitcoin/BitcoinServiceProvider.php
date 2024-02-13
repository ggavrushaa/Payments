<?php

namespace App\Services\Bitcoin;

use App\Services\Bitcoin\Commands\BitcoinTransactionsCommand;
use Illuminate\Support\ServiceProvider;

class BitcoinServiceProvider extends ServiceProvider 
{
    public function register(): void
    {
        $this->app->bind(BitcoinService::class, function() {
            $config = config('services.bitcoin');

            return new BitcoinService(
                new BitcoinConfig(
                    url: $config['url'],
                    user: $config['user'],
                    password: $config['password'],
                )
            );
        });
    }

    public function boot(): void
    {
        if($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Migrations');

            $this->commands([
                BitcoinTransactionsCommand::class,
            ]);
        }
    }
}
