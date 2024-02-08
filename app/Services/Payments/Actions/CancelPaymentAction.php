<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Events\PaymentCancelledData;
use App\Services\Payments\Events\PaymentCancelleddData;
use App\Services\Payments\Events\PaymentCancelledEvent;
use App\Services\Payments\Models\Payment;

class CancelPaymentAction
{
    public function run(Payment $payment): void
    {
        $payment->update(['status' => PaymentStatusEnum::cancelled]);

        $data = PaymentCancelledData::fromPayment($payment);

        event(new PaymentCancelledEvent($data));

    }
}
