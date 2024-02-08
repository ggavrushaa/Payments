<?php

namespace App\Http\Controllers\Api\Payments\Callbacks;

use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Http\Request;
use UnexpectedValueException;
use App\Http\Controllers\Controller;
use App\Services\Payments\PaymentService;
use Stripe\Exception\SignatureVerificationException;

use function PHPSTORM_META\type;

class StripeController extends Controller
{
    public function __invoke(Request $request, PaymentService $payments)
    {
        info('stripe webhook', $request->all());

        Stripe::setApiKey(config('services.stripe.secret_key'));

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('stripe-signature'),
                config('services.stripe.webhook_key'),
            );
        } catch (UnexpectedValueException $e) {
            report($e); // invalid payload
            return response('', 200);
        } catch (SignatureVerificationException $e) {
            report($e); // invalid signature
            return response('', 200);
        }

        $payment = $payments->getPayments()
            ->uuid($event->data->object->metadata->uuid)
            ->first();

        match ($event->type) {
            'payment_intent.succeeded' => $payments->completePayment()->run($payment),
            'payment_intent.canceled' => $payments->cancelPayment()->run($payment),
        };

        return response('', 200);
    }

}
