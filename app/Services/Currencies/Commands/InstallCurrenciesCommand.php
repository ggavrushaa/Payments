<?php

namespace App\Services\Currencies\Commands;

use App\Support\Values\AmountValue;
use Illuminate\Console\Command;
use App\Services\Currencies\Models\Currency;
use App\Services\Currencies\Sources\SourceEnum;

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
            'name' => 'Рубль',
            'price' => new AmountValue(1),
            'source' => SourceEnum::manual,
        ]);

        Currency::query()
        ->firstOrCreate([
            'id'=> Currency::USD,
        ], [
            'name' => 'Доллар',
            'price' => new AmountValue(100),
            'source' => SourceEnum::cbrf,
        ]);

        Currency::query()
        ->firstOrCreate([
            'id'=> Currency::EUR,
        ], [
            'name' => 'Евро',
            'price' => new AmountValue(110),
            'source' => SourceEnum::cbrf,
        ]);
    }
}
