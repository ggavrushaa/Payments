<?php

namespace App\Services\Tinkoff\Entities;

use App\Services\Tinkoff\Enums\PaymentStatusEnum;

class PaymentEntity
{
    public function __construct(
        public string $id,
        public PaymentStatusEnum $status,
        public string $order,
        public int $amount,
        public ?string $url = null,
    ) {
        //
    }
}
