<?php

namespace App\Services\Payments\Events;

class PaymentCancelledEvent
{
    public function __construct(public PaymentCancelledData $data)
    {
        //
    }
}
