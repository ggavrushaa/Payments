<?php

namespace App\Services\Payments\Enums;

enum PaymentDriverEnum: string
{
    case test = 'test';
    case tinkoff = 'tinkoff';
    case stripe_elements = 'stripe_elements';

    public function name(): string
    {
        return match ($this) {
            self::test => "Тестовый провайдер",
            self::tinkoff => "Tinkoff",
    };
  }

  public function isTest(): bool
  {
    return $this === self::test;
  }

}