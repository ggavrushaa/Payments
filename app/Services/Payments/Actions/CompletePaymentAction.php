<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Events\PaymentCompletedData;
use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Payments\Models\Payment;


class CompletePaymentAction
{
    public function run(Payment $payment, array $data = []): void
    {
        $payment->update(['status' => PaymentStatusEnum::completed, ...$data]);

       $data = PaymentCompletedData::fromPayment($payment);
       event(new PaymentCompletedEvent($data)); 

    }
}
