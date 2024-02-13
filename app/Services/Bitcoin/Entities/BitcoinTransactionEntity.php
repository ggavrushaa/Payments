<?php

namespace App\Services\Bitcoin\Entities;

use App\Services\Bitcoin\Enums\BitcoinTransactionCategoryEnum;
use App\Services\Bitcoin\Values\BitcoinAmountValue;

class BitcoinTransactionEntity
{
    public function __construct(
        public string $hash,
        public string $address,
        public BitcoinTransactionCategoryEnum $category,
        public string $amount,
        public int $confirmations,
    ) {
        
    }
}
