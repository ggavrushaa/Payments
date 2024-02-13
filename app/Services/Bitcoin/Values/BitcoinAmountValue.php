<?php

namespace App\Services\Bitcoin\Values;

use InvalidArgumentException;

class BitcoinAmountValue
{
    public readonly string $value;

    public function __construct($value)
    {
        if(!is_numeric($value)) {
            throw new InvalidArgumentException(
                'Invalid amount value: ' . $value,
            );
        }
        $this->value;
    }

}
