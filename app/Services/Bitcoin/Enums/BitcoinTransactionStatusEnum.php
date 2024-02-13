<?php

namespace App\Services\Bitcoin\Enums;

enum BitcoinTransactionStatusEnum: string
{
    case completed = 'completed';
    case pending = 'pending';
    case cancelled = 'cancelled';

    public function isPending(): bool
    {
        return $this === static::pending;
    }

    public function isNotPending(): bool
    {
        return !$this->isPending();
    }
}
