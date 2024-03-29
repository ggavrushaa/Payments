<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Services\Orders\Models\Order;
use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Models\Payment;
use App\Services\Payments\Models\PaymentMethod;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
/**
 * @property PaymentMethod $method
 */
class PaymentController extends Controller
{
    public function checkout(Payment $payment, PaymentService $paymentService)
    {
        $methods = $paymentService
        ->getPaymentMethods()
        // ->currency($payment->currency_id)
        ->active(true)
        ->get();

        return view("payments.checkout", compact('payment', 'methods'));
    }
    public function method(
    UpdatePaymentRequest $request, 
    PaymentService $paymentService,
    Payment $payment, 
    ) {
        abort_unless($payment->status->isPending(), 404);
        
        
        $method = $paymentService
        ->getPaymentMethods()
        ->id($request->input('method_id'))
        ->active()
        ->first();

        abort_unless($method, 404);
        // abort_unless($payment->currency_id === $method->driver_currency_id, 404);

        $paymentService
        ->updatePayment()
        ->method($method)
        ->run($payment);

        return redirect()->route('payments.process', $payment->uuid);
    }

    public function process(Payment $payment, PaymentService $paymentService)
    {
        abort_unless($payment->method_id, 404);

        if($payment->status->isCompleted()) {
            return redirect()->route('payments.success', ['uuid'=> $payment->uuid]);
        }
        if($payment->status->isCancelled()) {
            return redirect()->route('payments.failure', ['uuid'=> $payment->uuid]);
        }

        $driver =  $paymentService->getDriver($payment->driver);
       
       return $driver->view($payment);
    }

    //only Test payment method 
    public function complete(Payment $payment, PaymentService $paymentService)
    {
        abort_unless($payment->status->isPending(), 404);
        abort_unless($payment->driver->isTest(), 404);
        abort_if(app()->isProduction(), 404);

        $paymentService->completePayment()->run($payment);

        return redirect()->route('payments.success', [
            'uuid'=> $payment->uuid
        ]);
    }
    public function cancel(Payment $payment, PaymentService $paymentService)
    {
        abort_unless($payment->status->isPending(), 404);
        abort_unless($payment->driver->isTest(), 404);
        abort_if(app()->isProduction(), 404);

        $paymentService->cancelPayment()->run($payment);    

        return redirect()->route('payments.failure', [
            'uuid'=> $payment->uuid
        ]);
    }

    public function success(Request $request, Payment $payment, PaymentService $paymentService)
    {
        $uuid = $request->input('uuid');
        abort_unless(Str::isUuid($uuid), 404);
        
       $payment = $paymentService
       ->getPayments()
       ->uuid($uuid)
        ->first();

        abort_unless($payment, 404);

        
        return view('payments.success', compact('payment'));

    }
    public function failure(Request $request, Payment $payment, PaymentService $paymentService)
    {
        $uuid = $request->input('uuid');
        abort_unless(Str::isUuid($uuid), 404);

        $payment = $paymentService
        ->getPayments()
        ->uuid($uuid)
         ->first();
 
         abort_unless($payment, 404);

        return view('payments.failure', compact('payment'));
    }

}
