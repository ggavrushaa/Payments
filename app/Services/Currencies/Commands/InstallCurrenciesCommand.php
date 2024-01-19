<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\Models\Currency;
use Illuminate\Console\Command;

class InstallCurrenciesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:install';

  
    public function handle()
    {
        $this->warn('Идет установка валют...');
        $this->instalCurrencies();
        $this->info('Валюты установлены!');
    }

    public function instalCurrencies(): void
    {
        Currency::query()
        ->firstOrCreate([
            'id'=> Currency::RUB,
        ], [
            'name'=> 'Рубль',
        ]);
    }
}
