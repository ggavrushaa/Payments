<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Models\Payment;


class CompletePaymentAction
{
    public function run(Payment $payment): bool
    {
        $payment->status = PaymentStatusEnum::completed;

        $updated = $payment->save();

        $payment->payable->onPaymentCompleted();

        return $updated;
    }
}
