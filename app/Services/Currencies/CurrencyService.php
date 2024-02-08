<?php

namespace App\Services\Currencies;

use App\Services\Currencies\Sources\Source;
use App\Services\Currencies\Sources\SourceEnum;
use App\Services\Currencies\Sources\SourceFactory;
use App\Services\Currencies\Actions\ConvertCurrencyAction;
use App\Services\Currencies\Actions\UpdateCurrencyPricesAction;


class CurrencyService
{
    public function getSource(SourceEnum $source): Source
    {
        return SourceFactory::make($source);
    }

    public function updatePrices(): UpdateCurrencyPricesAction
    {
        return app(UpdateCurrencyPricesAction::class);
    }

    public function convert(): ConvertCurrencyAction
    {
        return app(ConvertCurrencyAction::class);
    }
}
