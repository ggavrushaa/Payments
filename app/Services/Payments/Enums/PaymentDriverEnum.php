<?php

namespace App\Services\Payments\Enums;

enum PaymentDriverEnum: string
{
    case test = 'test';
    case tinkoff = 'tinkoff';
    case bitcoin = 'bitcoin';
    case stripe_elements = 'stripe_elements';
    case stripe_checkout = 'stripe_checkout';

    public function name(): string
    {
        return match ($this) {
            self::test => "Тестовый провайдер",
            self::tinkoff => "Tinkoff",
            self::bitcoin => "Bitcoin",
            self::stripe_elements => "Stripe Elements",
            self::stripe_checkout => "Stripe Checkout",
    };
  }

  public function isTest(): bool
  {
    return $this === self::test;
  }

}