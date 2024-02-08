<?php

namespace App\Console;

use App\Services\Currencies\Commands\UpdateCurrencyPricesCommand;
use App\Services\Currencies\Sources\SourceEnum;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(UpdateCurrencyPricesCommand::class, [SourceEnum::cbrf->value])->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load([
            __DIR__.'/Commands',
            app_path('Services/Orders/Commands'),
            app_path('Services/Currencies/Commands'),
        ]);

        require base_path('routes/console.php');
    }
}
