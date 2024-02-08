<?php

namespace App\Providers;

use App\Services\Tinkoff\TinkoffConfig;
use Illuminate\Support\ServiceProvider;
use App\Services\Tinkoff\TinkoffService;

class TinkoffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TinkoffService::class, function () {
            $config = config('services.tinkoff');

                return new TinkoffService(
                new TinkoffConfig(
                    terminal: $config['terminal'],
                    password: $config['password'],
                ),
            ); 
        });
    }

    public function boot(): void
    {
        
    }
}
