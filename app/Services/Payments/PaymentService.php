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
        return new CreatePaymentAction;
    }
    public function getPaymentMethods(): GetPaymentMethodsAction
    {
        return new GetPaymentMethodsAction;
    }
    public function updatePayment(): UpdatePaymentAction
    {
        return new UpdatePaymentAction;
    }
    public function completePayment(): CompletePaymentAction
    {
        return new CompletePaymentAction;
    }
    public function cancelPayment(): CancelPaymentAction
    {
        return new CancelPaymentAction;
    }

    public function getPayments(): GetPaymentsAction
    {
        return new GetPaymentsAction;
    }
    
}