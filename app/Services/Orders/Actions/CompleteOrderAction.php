<?php

namespace App\Services\Orders\Actions;

use App\Services\Orders\Enums\OrderStatusEnum;
use App\Services\Orders\Models\Order;

class CompleteOrderAction
{
    public function run(Order $order): bool
    {
        $order->status = OrderStatusEnum::completed;
        return $order->save();
    }
}
