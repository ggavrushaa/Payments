<?php

namespace App\Services\Currencies\Sources;

use App\Services\Currencies\Sources\Source;

class SourceFactory
{
    public static function make(SourceEnum $source): Source
    {
        return match ($source) {
            SourceEnum::manual => app(ManualSource::class),
            SourceEnum::cbrf => app(CbrfSource::class),
        };
    }
}
