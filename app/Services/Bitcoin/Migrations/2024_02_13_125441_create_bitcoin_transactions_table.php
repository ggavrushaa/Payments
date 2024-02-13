<?php

use App\Services\Bitcoin\Enums\BitcoinTransactionStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bitcoin_transactions', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->timestamps();

            $table->string('hash');
            $table->string('address');
            $table->decimal('amount', 21, 8);
            $table->string('category');
            $table->integer('confirmations');
            $table->string('status')->default(BitcoinTransactionStatusEnum::pending->value);

            $table->unique(['hash', 'address', 'category']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitcoin_transactions');
    }
};
