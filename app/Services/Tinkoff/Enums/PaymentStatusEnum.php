<?php

namespace App\Services\Tinkoff\Enums;

enum PaymentStatusEnum: string
{
    case NEW = 'NEW';
    case CONFIRMED = 'CONFIRMED';
    case REJECTED = 'REJECTED';
    case AUTHORIZED = 'AUTHORIZED';
    case CANCELLED = 'CANCELLED';
    case REVERSED = 'REVERSED';
    case REFUNDED = 'REFUNDED';
}
