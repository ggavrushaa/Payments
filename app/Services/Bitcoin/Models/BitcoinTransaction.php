<?php

namespace App\Services\Bitcoin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\Bitcoin\Enums\BitcoinTransactionStatusEnum;
use App\Services\Bitcoin\Enums\BitcoinTransactionCategoryEnum;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $hash
 * @property string $address
 * @property BitcoinTransactionCategoryEnum $category
 * @property int $confirmations
 * @property BitcoinTransactionStatusEnum $status
 */
class BitcoinTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash', 'address',
        'category', 'amount',
        'confirmations',
        'status',
    ];
    protected $casts = [
        'category' =>  BitcoinTransactionCategoryEnum::class,
        'status' =>  BitcoinTransactionStatusEnum::class,
    ];
}
