<?php

namespace App\Services\Tinkoff;

use App\Services\Tinkoff\Entities\PaymentEntity;
use App\Services\Tinkoff\Actions\CreatePaymentData;
use App\Services\Tinkoff\Actions\FindPaymentAction;
use App\Services\Tinkoff\Actions\CancelPaymentAction;
use App\Services\Tinkoff\Actions\CheckCallbackAction;
use App\Services\Tinkoff\Actions\CreatePaymentAction;


class TinkoffService
{
    public function __construct(
        public TinkoffConfig $config,
    ) {
        //
    }

    public function createPayment(CreatePaymentData $data): PaymentEntity
    {
        return CreatePaymentAction::make($this)->run($data);
    }
    public function findPayment(string $id): PaymentEntity
    {
        return FindPaymentAction::make($this)->run($id);
    }
    public function cancelPayment(string $id): PaymentEntity
    {
        return CancelPaymentAction::make($this)->run($id);
    }
    public function checkCallback(array $data): PaymentEntity
    {
        return CheckCallbackAction::make($this)->run($data);
    }
}
