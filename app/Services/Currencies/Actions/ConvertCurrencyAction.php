<?php

namespace App\Services\Currencies\Actions;

use App\Support\Values\AmountValue;
use App\Services\Currencies\Models\Currency;

class ConvertCurrencyAction
{
    private string $from;
    private string $to;

    public function from(string $from): static
    {
        $this->from = $from;
        return $this;
    }

    public function to(string $to): static
    {
        $this->to = $to;
        return $this;
    }
    public function run(AmountValue $amount): AmountValue
    {
        $currencies = Currency::getCached();
        $from = $currencies->firstWhere('id', $this->from);
        $to = $currencies->firstWhere('id', $this->to);

        if($from->isNotMain()) {
            $amount = $amount->mul($from->price, 8);
        }

        $result = $amount->div($to->price, 8);
        return new AmountValue($result);
    }
}
