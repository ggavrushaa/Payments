<?php

namespace App\Services\Orders\Commands;
use App\Services\Orders\Factories\OrderFactory;
use Illuminate\Console\Command;

class InstallOrdersCommand extends Command
{
    
    protected $signature = 'orders:install';

  
    public function handle()
    {
        $this->warn('Идет установка ордеров...');
        OrderFactory::new()->count(100)->create();
        $this->info('Ордера установлены!');
    }

}
