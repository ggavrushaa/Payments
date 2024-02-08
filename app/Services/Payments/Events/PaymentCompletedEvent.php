<?php

namespace App\Services\Payments\Events;

class PaymentCompletedEvent
{
    public function __construct(public PaymentCompletedData $data)
    {
        //
    }
}
