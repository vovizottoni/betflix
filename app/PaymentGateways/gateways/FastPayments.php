<?php

namespace App\PaymentGateways\gateways;

use App\Enums\GatewayTransactionType;
use App\Enums\PixCashoutStatusEnum;
use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\PaymentGateways\interfaces\PixPaymentGatewayInterface;
use App\PaymentGateways\libs\FastPaymentsApi;
use App\PaymentGateways\libs\PagStarApi;
use App\PaymentGateways\responses\PixCashoutInfoResponse;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositResponse;
use App\PaymentGateways\responses\PixDepositInfoResponse;
use App\PaymentGateways\traits\PaymentGatewayTrait;
use Symfony\Component\Config\Definition\Exception\Exception;

class FastPayments implements PixPaymentGatewayInterface
{
    private $api;
    use PaymentGatewayTrait;

    public function __construct()
    {
        $this->api = new FastPaymentsApi();
    }

    public function newDeposit($value, $name, $document, $userId, $reference): PixDepositResponse
    {

        try {
            $response = $this->api->newDeposit($value, $name, $document, $userId);
            if (isset($response['link_qr'])) {
                $status = true;
                $qrcode_url = $response['link_qr'];
                $qrcode_content = $response['content_qr'];
                $ref = $response['external_reference'];
            } else {
                throw new \Exception("Deposit failed.");
            }
        } catch (\Exception) {
            $status = false;
            $qrcode_url = null;
            $qrcode_content = null;
            $ref = null;
        }
        return $this->depositResponse($status, $qrcode_url, $qrcode_content, $ref);

    }

    public function requestCashout($pixKey, $doc, $value, $transactionId): PixCashoutResponse
    {
        try {
            $response = $this->api->requestWithdrawal($transactionId);
            if (isset($response['status']) && $response['status'] == 'pending') {
                $status = true;
                $ref = $response['transaction_id'];
            } else {
                throw new \Exception("Cashout failed.");
            }
        } catch (\Exception $e) {
            $status = false;
            $ref = null;
            registerGatewayLogMessage($e->getMessage());

        }
        return $this->cashoutResponse($status, $ref);
    }

    public function getCashoutInfoFromRequest(array $requestData): PixCashoutInfoResponse
    {
        $requirdIndexs = ['order_id', 'status'];
        hasAllIndexsOrFails($requestData, $requirdIndexs);
        $externalReference = $this->getReferenceFromRequest($requestData);
        $status = null;
        if ($requestData['status'] == 'confirmed') {
            $status = PixCashoutStatusEnum::Paid;
        } elseif ($requestData['status'] == 'canceled') {
            $status = PixCashoutStatusEnum::Cancelled;
        }
        return $this->getCashoutInfoFromRequestResponse($status, $externalReference);
    }

    public function getDepositInfoFromRequest(array $requestData): PixDepositInfoResponse
    {
        $externalReference = $this->getReferenceFromRequest($requestData);
        $transaction = Transaction::whereExternalReference($externalReference)->incompleDeposits()->first();
        if (!is_null($externalReference) && isset($transaction['id'])) {
            $isPaid = $this->api->checkDepositPaymentStatus($externalReference);
            return $this->getDepositInfoFromRequestResponse($isPaid, $externalReference);
        } else {
            return $this->getDepositInfoFromRequestResponse(false, null);
        }
    }

    public function getReferenceFromRequest(array $requestData): ?string
    {
        if (isset($requestData['order_id']) && !empty($requestData['order_id'])) {
            return $requestData['order_id'];
        }
        return null;
    }


}
