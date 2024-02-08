<?php

namespace App\Services\Payments\Events;

use App\Services\Payments\Models\Payment;

readonly class PaymentCancelledData
{
    public function __construct(
        public string $uuid, 
        public string $payableType,
        public string $payableId,
        ) {
        }

    public static function fromPayment(Payment $payment): static
    {
        return new static(
            uuid: $payment->uuid,
            payableType: $payment->payable_type,
            payableId: $payment->payable_id,
        );
    }
}
