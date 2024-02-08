<?php

namespace App\Services\Payments\Drivers;


use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use Illuminate\Contracts\View\View;
use App\Services\Payments\Models\Payment;

class StripeCheckoutDriver extends PaymentDriver
{
    public function view(Payment $payment): View
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        
        $session = Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'success_url' => route('payments.success', ['uuid' => $payment->uuid]),
            'cancel_url' => route('payments.failure', ['uuid' => $payment->uuid]),
            'payment_intent_data' => ['metadata' => ['uuid' => $payment->uuid]],
            'line_items' => [[
              'quantity' => 1,
              'price_data' => [
                'unit_amount' => $payment->driver_amount->value() * 100,
                'currency' => strtolower($payment->driver_currency_id),
                'product_data' => ['name' => $payment->payable->getPayableName()],
                     ],
                ]],
          ]);

        return view('payments::stripe-checkout', [
            'payment' => $payment,
            'session' => $session,
        ]);
    }
}
