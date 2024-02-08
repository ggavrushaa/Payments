<?php 

namespace App\Services\Payments\Drivers;
use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Drivers\TestPaymentDriver;

class PaymentDriverFactory
{
    public function make(PaymentDriverEnum $driver): PaymentDriver
    {
        return match ($driver) {
            PaymentDriverEnum::test => app(TestPaymentDriver::class),
            PaymentDriverEnum::tinkoff => app(TinkoffDriver::class),
            PaymentDriverEnum::stripe_elements => app(StripeElementsDriver::class), 

            default => throw new \InvalidArgumentException (
                "Драйвер {{$driver->value}} не поддерживается"
            ),
        };
    }
}