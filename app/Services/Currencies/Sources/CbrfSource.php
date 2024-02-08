<?php

namespace App\Services\Currencies\Sources;

use Illuminate\Support\Collection;
use App\Support\Values\AmountValue;
use App\Services\Currencies\Sources\SourceEnum;

class CbrfSource extends Source
{
    public function enum(): SourceEnum
    {
        return SourceEnum::cbrf;
    }
    public function getPrices(): Collection
    {
        $response = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange');
        $response = simplexml_load_string($response);
        $response = json_encode($response);
        $response = json_decode($response);
    
        $prices = new Collection([]);

        foreach ($response->currency as $data) {
            $value = str_replace(',', '.', $data->rate);

            $prices->push(new SourcePrice(
                currency: $data->cc,
                value: new AmountValue($value),
            ));
        }

        return $prices;
    }
}
