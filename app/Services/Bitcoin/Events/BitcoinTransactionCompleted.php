<?php

namespace App\Services\Bitcoin\Events;

use App\Services\Bitcoin\Entities\BitcoinTransactionEntity;

class BitcoinTransactionCompleted
{
    public function __construct(
        public BitcoinTransactionEntity $entity,
    )
    {
        info('BitcoinTransactionCompleted', [$entity]);
    }
}
