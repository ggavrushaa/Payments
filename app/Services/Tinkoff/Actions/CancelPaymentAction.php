<?php

namespace App\Services\Tinkoff\Actions;
use App\Services\Tinkoff\TinkoffService;
use App\Services\Tinkoff\Entities\PaymentEntity;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\TinkoffClient;

class CancelPaymentAction
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
            ->post('Cancel', [
                'TerminalKey' => $this->tinkoff->config->terminal,
                'PaymentId' => $id,
            ]);
 
         return new PaymentEntity(
             id: $response['PaymentId'],
             status: PaymentStatusEnum::from($response['Status']),
             order: $response['OrderId'],
             amount: $response['NewAmount'],
         );
     }


}
