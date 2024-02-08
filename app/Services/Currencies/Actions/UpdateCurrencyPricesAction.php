<?php

namespace App\Services\Currencies\Actions;

use App\Services\Currencies\Models\Currency;
use App\Services\Currencies\Sources\Source;
use App\Services\Currencies\Sources\SourceException;
use Illuminate\Database\Eloquent\Collection;

class UpdateCurrencyPricesAction
{
    public function run(Source $source): Collection
    {
        $currencies = Currency::query()
            ->where('source', $source->enum())
            ->get();
        
        if($currencies->isEmpty()) {
            return $currencies;
        }

        $prices = $source->getPrices();
        
        if($prices->isEmpty()) {
            return $currencies;
        }

        foreach($currencies as $currency) {
           $price = $prices->firstWhere('currency', $currency->id);

           is_null($price) && throw new SourceException(
               'Не удалось получить курс для валюты ' . $currency->id,
           );

           $currency->update(['price' => $price->value]);
        }
        
        return $currencies;
    }
}
