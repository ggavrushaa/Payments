<?php

namespace App\Services\Tinkoff\Actions;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;
use App\Services\Tinkoff\Entities\PaymentEntity;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;

class CreatePaymentAction
{
    public function __construct(
       private TinkoffService $tinkoff,
    ) {
        //
    }

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function run(CreatePaymentData $data): PaymentEntity
    {
        $response =  TinkoffClient::make($this->tinkoff)
            ->post('Init', [
                'TerminalKey' => $this->tinkoff->config->terminal,
                'Amount' => $data->amount,
                'OrderId' => $data->order,
                'SuccessURL' => $data->successUrl,
                'FailURL' => $data->failureUrl,
                'NotificationURL' => $data->callbackUrl,
            ]);
 

        return new PaymentEntity(
            id: $response['PaymentId'],
            status: PaymentStatusEnum::from($response['Status']),
            order: $response['OrderId'],
            amount: $response['Amount'],
            url: $response['PaymentURL'],
        );

    }
}
