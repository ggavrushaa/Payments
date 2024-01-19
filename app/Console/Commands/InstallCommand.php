<?php

namespace App\Console\Commands;
use App\Services\Currencies\Commands\InstallCurrenciesCommand;
use App\Services\Orders\Commands\InstallOrdersCommand;

   
use App\Services\Payments\Commands\InstallPaymentsCommand;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'install';

    public function handle()
    {
        $this->warn('Устанвока приложения...');

        $this->call(InstallCurrenciesCommand::class);
        $this->call(InstallOrdersCommand::class);
        $this->call(InstallPaymentsCommand::class);
       
        $this->info('Приложение установлено');
    }
}
