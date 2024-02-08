<?php

namespace App\Services\Payments\Actions;

use App\Support\Values\AmountValue;
use App\Services\Payments\Models\Payment;
use App\Services\Payments\Models\PaymentMethod;
use App\Services\Payments\Contracts\PaymentConverter;

class UpdatePaymentAction
{
    private PaymentMethod | null $method;

    public function __construct(
        private PaymentConverter  $converter,
    )
    {
        
    }

    public function method(PaymentMethod $method): static
    {
        $this->method = $method;
        return $this;   
    }

    public function run(Payment $payment): bool
    {
        if(!is_null($this->method)) {
            $payment->method_id = $this->method->id;
            $payment->driver = $this->method->driver;
            $payment->driver_currency_id = $this->method->driver_currency_id;
            $payment->driver_amount = $this->convertAmount($payment);
        }

        return $payment->save();
    }

    private function convertAmount(Payment $payment): AmountValue
    {
        return $this->converter
        ->convert(
            amount: $payment->amount,
            from: $payment->currency_id,
            to: $payment->driver_currency_id,
        );
    }
}
