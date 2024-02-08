<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\CurrencyService;
use App\Services\Currencies\Sources\SourceEnum;
use Illuminate\Console\Command;

class UpdateCurrencyPricesCommand extends Command
{
 
    protected $signature = 'currencies:prices {source}';

 
    protected $description = 'Обновление котировок валют';


    public function handle(CurrencyService $service)
    {
        $this->warn('Идет обновление курсов валют...');

        $this->updatePrices($service);

        $this->info('Обновление прошло успешно!');
    }

    private function updatePrices(CurrencyService $service): void
    {
        $source = $service->getSource(
            SourceEnum::from($this->argument('source'))
        );

        $service->updatePrices()->run($source);
        
    }
}
