<?php

namespace App\Services\Payments\Models;

use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string|null $driver_wallet
 * 
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'uuid',
        'status',
        'currency_id', 'amount',
        'payable_type', 'payable_id',
        'method_id',

        'drivers', 
        'driver_payment_id', 'driver_wallet',
        'driver_currency_id', 'driver_amount',
    ];
    protected $casts = [ 
        'status' => PaymentStatusEnum::class,
        'amount' => AmountValue::class,

        'driver' => PaymentDriverEnum::class,
        'driver_amount' => AmountValue::class,
    ];

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
