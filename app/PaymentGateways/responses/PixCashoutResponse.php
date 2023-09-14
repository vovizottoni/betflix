<?php

namespace App\PaymentGateways\responses;

class PixCashoutResponse
{
    private $ref;
    private $status;

    public function __construct(bool $status, ?string $ref)
    {
        $this->ref = $ref;
        $this->status = $status;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
