<?php

namespace App\Services\Subscriptions\Listeners;

use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Subscriptions\Enums\SubscriptionStatusEnum;
use App\Services\Subscriptions\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateSubscriptionListener implements ShouldQueue
{
   
    public function __construct()
    {
        //
    }

    public function handle(PaymentCompletedEvent $event): void
    {
        $payableType = $event->data->payableType;
        $payableId = $event->data->payableId;

        // не подписка
        if($payableType !== (new Subscription)->getPayableType()) {
            return;
        }

        $subscription = Subscription::query()
        ->find($payableId);

        if(is_null($subscription)) {
            return;
        }

        $subscription->update(['status' => SubscriptionStatusEnum::active]);
    }
}
