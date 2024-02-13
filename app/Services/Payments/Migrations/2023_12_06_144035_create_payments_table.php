<?php

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->uuid('uuid')->unique();
            $table->timestamps();

            $table->string('status');
            $table->string('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->decimal('amount',12,2);
           
            $table->string('payable_type');
            $table->integer('payable_id');

            $table->foreignId('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('payment_methods');

            $table->string('driver')->nullable();
            $table->string('driver_currency_id')->nullable()->comment('Валюта провидера');
            $table->foreign('driver_currency_id')->references('id')->on('currencies');
            $table->decimal('driver_amount', 21, 8)->nullable();
            $table->string('driver_payment_id')->nullable()->comment('ID платежа в определённом драйвере');
            $table->string('driver_wallet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
