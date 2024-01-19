<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\Payment;
use App\Services\Payments\Models\PaymentMethod;

class UpdatePaymentAction
{
    private PaymentMethod | null $method;

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
        }

        return $payment->save();
    }
}
