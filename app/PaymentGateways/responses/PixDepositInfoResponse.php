<?php

namespace App\PaymentGateways\responses;

class PixDepositInfoResponse
{
    private $ref;
    private $paid;

    public function __construct(bool $paid, ?string $ref)
    {
        $this->ref = $ref;
        $this->paid = $paid;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }
}
