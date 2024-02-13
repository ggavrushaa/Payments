<?php

namespace App\Services\Currencies\Models;

use App\Services\Currencies\Sources\SourceEnum;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 */
class Currency extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name',
        'price', 'source'
    ];
    protected $casts = [
        'source' => SourceEnum::class,
        'price' => AmountValue::class,
    ];

    public const MAIN = 'RUB';
    public const RUB = 'RUB';
    public const USD = 'USD';
    public const EUR = 'EUR';
    public const BTC = 'BTC';

    public function isMain(): bool
    {
        return $this->id == static::MAIN;
    }
    public function isNotMain(): bool
    {
        return !$this->isMain();
    }

    public static function getCached(): Collection
    {
        static $cached;

        if($cached) {
            return $cached;
        }

        return $cached = static::all();
    }
}
