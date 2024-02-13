<?php

namespace App\Services\Payments\Drivers;

use App\Services\Bitcoin\BitcoinService;
use Illuminate\Contracts\View\View;
use App\Services\Payments\Models\Payment;

class BitcoinDriver extends PaymentDriver
{
    public function __construct(
        private BitcoinService $bitcoin,
    ) {
    }
    public function view(Payment $payment): View
    {
        if(is_null($payment->driver_wallet)) {
            $payment->update(['driver_wallet' => $this->bitcoin->getNewAddress()]);
        }

        return view('payments::bitcoin', compact('payment'));
    }
}
