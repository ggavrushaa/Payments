<?php

namespace App\Services\Tinkoff\Actions;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;
use App\Services\Tinkoff\Entities\PaymentEntity;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;


class FindPaymentAction
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
 
     public function run(string $id): PaymentEntity
     {
        $response =  TinkoffClient::make($this->tinkoff)
        ->post('GetState', [
            'TerminalKey' => $this->tinkoff->config->terminal,
            'PaymentId' => $id,
        ]);
 
         return new PaymentEntity(
             id: $response['PaymentId'],
             status: PaymentStatusEnum::from($response['Status']),
             order: $response['OrderId'],
             amount: $response['Amount'],
         );
     }
}
