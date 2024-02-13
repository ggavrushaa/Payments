<?php

namespace App\Services\Bitcoin\Entities;

use App\Services\Bitcoin\Enums\BitcoinTransactionCategoryEnum;
use App\Services\Bitcoin\Models\BitcoinTransaction;
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

    public static function fromModel(BitcoinTransaction $transaction): static
    {   
        return new static(
            hash: $transaction->hash,
            address: $transaction->address,
            category: $transaction->category,
            amount: $transaction->amount, 
            confirmations: $transaction->confirmations, 
        );
    }
}
