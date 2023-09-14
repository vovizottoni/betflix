<?php

namespace App\PaymentGateways\responses;

class PixDepositResponse
{
    private $qrCodeUrl;
    private $qrCodeContent;
    private $ref;
    private $status;

    public function __construct(bool $status, ?string $qrCodeUrl, ?string $qrCodeContent, ?string $ref)
    {
        $this->qrCodeUrl = $qrCodeUrl;
        $this->qrCodeContent = $qrCodeContent;
        $this->ref = $ref;
        $this->status = $status;

    }

    public function getQrCodeUrl(): ?string
    {
        return $this->qrCodeUrl;
    }

    public function getQrCodeContent(): ?string
    {
        return $this->qrCodeContent;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function hasQrcode(): bool
    {
        if (is_null($this->getQrCodeUrl())) {
            return false;
        }
        return true;
    }

}
