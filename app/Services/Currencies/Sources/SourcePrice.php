<?php

namespace App\Services\Currencies\Sources;

use App\Support\Values\AmountValue;

class SourcePrice
{
    public function __construct(
        public string $currency,
        public AmountValue $value,
    ) {
        //
    }
}
