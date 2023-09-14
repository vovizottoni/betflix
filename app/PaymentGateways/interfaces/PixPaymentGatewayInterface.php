<?php

namespace App\PaymentGateways\interfaces;

use App\Models\Transaction;
use App\PaymentGateways\responses\PixCashoutInfoResponse;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositInfoResponse;
use App\PaymentGateways\responses\PixDepositResponse;

interface PixPaymentGatewayInterface
{
    public function newDeposit($value, $name, $document, $userId, $reference): PixDepositResponse;

    public function requestCashout($pixKey, $doc, $value, $transactionId): PixCashoutResponse;

    public function getReferenceFromRequest(array $requestData): ?string;

    public function getDepositInfoFromRequest(array $requestData): PixDepositInfoResponse;

    public function getCashoutInfoFromRequest(array $requestData): PixCashoutInfoResponse;

}
