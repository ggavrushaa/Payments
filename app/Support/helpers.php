<?php 

use App\Support\Values\AmountValue;
use App\Services\Currencies\CurrencyService;
use App\Services\Currencies\Models\Currency;

function currency(): string
{
  return session('currency', Currency::MAIN);
}

function convert(AmountValue $amount): AmountValue
{
    /** @var CurrencyService */
    $service = app(CurrencyService::class);

    return $service->convert()
    ->from(Currency::MAIN)
    ->to(currency())
    ->run($amount);
}

function money(AmountValue $amount, string $currency, int $scale = 2): string
{
    $amount = $amount->add(new AmountValue(0), $scale);
    return "{$amount} {$currency}";
}