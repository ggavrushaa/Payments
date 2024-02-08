<?php

namespace App\Services\Payments\Commands;

use App\Services\Currencies\Models\Currency;
use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Models\PaymentMethod;
use Illuminate\Console\Command;

class InstallPaymentsCommand extends Command
{
    
    protected $signature = 'payments:install';

    public function handle()
    {
        $this->warn('Установка платежей');

        $this->installPaymentMethods();

        $this->info('Платежи установлены');
    }

    private function installPaymentMethods(): void
    {
        PaymentMethod::query()
        ->firstOrCreate([
            'driver' => PaymentDriverEnum::test,
            'driver_currency_id' => Currency::RUB,
        ], [
            'name' => 'Тестовый способ',
            'active' => ! app()->isProduction(),
        ]);

    PaymentMethod::query()
        ->firstOrCreate([
            'driver' => PaymentDriverEnum::test,
            'driver_currency_id' => Currency::USD,
        ], [
            'name' => 'Тестовый способ',
            'active' => ! app()->isProduction(),
        ]);

    PaymentMethod::query()
        ->firstOrCreate([
            'driver' => PaymentDriverEnum::tinkoff,
            'driver_currency_id' => Currency::RUB,
        ], [
            'name' => 'Банковская карта',
            'active' => false,
        ]);

    PaymentMethod::query()
        ->firstOrCreate([
            'driver' => PaymentDriverEnum::stripe_elements,
            'driver_currency_id' => Currency::USD,
        ], [
            'name' => 'Stripe Elements',
            'active' => false,
        ]);

    PaymentMethod::query()
        ->firstOrCreate([
            'driver' => PaymentDriverEnum::stripe_checkout,
            'driver_currency_id' => Currency::USD,
        ], [
            'name' => 'Stripe Checkout',
            'active' => false,
        ]);

    }
}
