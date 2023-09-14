<?php

namespace App\PaymentGateways\responses;

use App\Enums\PixCashoutStatusEnum;

class PixCashoutInfoResponse
{
    private $ref;
    private $status;

    public function __construct(?string $status, ?string $ref)
    {
        $this->ref = $ref;
        $this->status = $status;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function isPaid(): bool
    {
        if ($this->status == PixCashoutStatusEnum::Paid) {
            return true;
        }
        return false;
    }

    public function isCancelled(): bool
    {
        if ($this->status == PixCashoutStatusEnum::Cancelled) {
            return true;
        }
        return false;
    }
}
