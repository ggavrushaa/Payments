<?php

namespace App\Services\Subscriptions\Enums;

enum SubscriptionStatusEnum: string
{
    case active = 'Активная';
    case pending = 'pending';
    case cancelled = 'cancelled';

    public function name(): string
    {
        return match ($this) {
            self::pending => "Ожидает",
            self::active => "Активная",
            self::cancelled => "Отменено",
    };
  }
    public function color(): string
    {
        return match ($this) {
            self::pending => "warning",
            self::active => "success",
            self::cancelled => "danger",
        };
  }
  public function is(SubscriptionStatusEnum $status)
  {
    return $this === $status;
  }
  public function isPending(): bool
  {
    return $this->is(self::pending);
  }
  public function isActive(): bool
  {
    return $this->is(self::active);
  }
  public function isCancelled(): bool
  {
    return $this->is(self::cancelled);
  }
}
