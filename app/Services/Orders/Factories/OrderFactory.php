<?php

namespace App\Services\Orders\Factories;

use App\Services\Currencies\Models\Currency;
use App\Services\Orders\Enums\OrderStatusEnum;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\Orders\Models\Order;

class OrderFactory extends Factory
{
  protected $model = Order::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'status' => OrderStatusEnum::pending,
            'currency_id' => Currency::RUB,
            'amount' => new AmountValue($this->faker->randomFloat(2,1,10000)),
        ];
    }
}
