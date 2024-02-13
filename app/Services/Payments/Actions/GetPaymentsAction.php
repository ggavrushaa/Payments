<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\Payment;

class GetPaymentsAction
{
    private string|null $uuid = null;
    private string|null $wallet = null;

    public function uuid(string $uuid): static
    {
        $this->uuid = $uuid;
        return $this;
    }
    public function wallet(string $wallet): static
    {
        $this->wallet = $wallet;
        return $this;
    }

    public function first(): Payment|null
    {
        $query = Payment::query();

        if(!is_null($this->uuid)) {
            $query->where('uuid', $this->uuid);
        }

        if(!is_null($this->wallet)) {
            $query->where('driver_wallet', $this->wallet);
        }

        return $query->first(); 
    }
}
