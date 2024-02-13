<?php

namespace App\Services\Payments\Listeners;

use App\Services\Bitcoin\Events\BitcoinTransactionCompleted;
use App\Services\Payments\PaymentService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletePaymentListener implements ShouldQueue
{
    public function __construct(
        private PaymentService $payments,
    )
    {

    }
    public function handle(BitcoinTransactionCompleted $event): void
    {
        $transaction = $event->entity;

        info('CompletePaymentListener', [$transaction]);

        //Отсекли "неправильные" транзакции
        if ($transaction->category->isNotRecieve()) {
            return;
        }

        //Нашли платеж по адресу транзакции
        $payment = $this->payments
        ->getPayments()
        ->wallet($transaction->address)
        ->first();

        if (is_null($payment)) {
            return;
        }


        //Проверили статус платежа (ожидает)
        if ($payment->status->isNotPending()) {
            return;
        }


        //Проверили сумму платежа
        if($payment->driver_amount->value() !== $transaction->amount) {
            return;
        }

        //Завершаем платеж
        $this->payments
        ->completePayment()
        ->run($payment, ['driver_payment_id' => $transaction->hash]);

    }
}
