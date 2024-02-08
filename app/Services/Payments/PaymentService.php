<?php

namespace App\Services\Payments;

use App\Services\Payments\Actions\CancelPaymentAction;
use App\Services\Payments\Actions\CompletePaymentAction;
use App\Services\Payments\Drivers\PaymentDriver;
use App\Services\Payments\Drivers\PaymentDriverFactory;
use App\Services\Payments\Drivers\TestPaymentDriver;
use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Actions\CreatePaymentAction;
use App\Services\Payments\Actions\GetPaymentMethodsAction;
use App\Services\Payments\Actions\GetPaymentsAction;
use App\Services\Payments\Actions\UpdatePaymentAction;
use Illuminate\Validation\Rules\Can;

class PaymentService
{
    public function getDriver(PaymentDriverEnum $driver): PaymentDriver
    {
        return (new PaymentDriverFactory)->make($driver);
    }

    public function createPayment(): CreatePaymentAction
    {
        return app(CreatePaymentAction::class);
    }
    public function getPaymentMethods(): GetPaymentMethodsAction
    {
        return app(GetPaymentMethodsAction::class);
    }
    public function updatePayment(): UpdatePaymentAction
    {
        return app(UpdatePaymentAction::class);
    }
    public function completePayment(): CompletePaymentAction
    {
        return app(CompletePaymentAction::class);
    }
    public function cancelPayment(): CancelPaymentAction
    {
        return app(CancelPaymentAction::class);
    }

    public function getPayments(): GetPaymentsAction
    {
        return app(GetPaymentsAction::class);
    }


    
}