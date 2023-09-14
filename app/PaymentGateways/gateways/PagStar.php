<?php

namespace App\PaymentGateways\gateways;

use App\Enums\PixCashoutStatusEnum;
use App\Models\Transaction;
use App\PaymentGateways\interfaces\PixPaymentGatewayInterface;
use App\PaymentGateways\libs\PagStarApi;
use App\PaymentGateways\responses\PixCashoutInfoResponse;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositResponse;
use App\PaymentGateways\responses\PixDepositInfoResponse;
use App\PaymentGateways\traits\PaymentGatewayTrait;
use Symfony\Component\Config\Definition\Exception\Exception;

class PagStar implements PixPaymentGatewayInterface
{
    private $api;
    use PaymentGatewayTrait;

    public function __construct()
    {
        $this->api = new PagStarApi();
    }

    public function newDeposit($value, $name, $document, $userId, $reference): PixDepositResponse
    {

        try {
            $response = $this->api->newDeposit($reference, $value, $name, $document);
            if ($response['data']['qr_code_url']) {
                $status = true;
                $qrcode_url = $response['data']['qr_code_url'];
                $qrcode_content = $response['data']['pix_key'];
                $ref = $response['data']['external_reference'];
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
            $response = $this->api->requestWithdrawal($pixKey, $doc, $value, $transactionId);
            if (isset($response['status']) && $response['status'] === true) {
                $status = true;
                $ref = $response['ref'];
            } else {
                throw new \Exception("Cashout failed.");
            }
        } catch (\Exception) {
            $status = false;
            $ref = null;
        }
        return $this->cashoutResponse($status, $ref);
    }

    public function getCashoutInfoFromRequest(array $requestData): PixCashoutInfoResponse
    {
        $requirdIndexs = ['type', 'status', 'transaction_id'];
        hasAllIndexsOrFails($requestData, $requirdIndexs);
        $externalReference = $this->getReferenceFromRequest($requestData);
        if (!is_null($externalReference) && $requestData['type'] == 'transfer') {
            $status = null;
            if ($requestData['status'] == 'approved' || $requestData['status'] == 'Aprovado') {
                $status = PixCashoutStatusEnum::Paid;
            } elseif ($requestData['status'] == 'canceled' || $requestData['status'] == 'Recusado') {
                $status = PixCashoutStatusEnum::Cancelled;
            }
            return $this->getCashoutInfoFromRequestResponse($status, $externalReference);
        } else {
            return $this->getCashoutInfoFromRequestResponse(null, null);
        }
    }

    public function getDepositInfoFromRequest(array $requestData): PixDepositInfoResponse
    {
        $externalReference = $this->getReferenceFromRequest($requestData);
        if (!is_null($externalReference) && $requestData['type'] == 'pay') {
            $isPaid = $this->api->isPaid($externalReference);
            return $this->getDepositInfoFromRequestResponse($isPaid, $externalReference);
        } else {
            return $this->getDepositInfoFromRequestResponse(false, null);
        }
    }

    public function getReferenceFromRequest(array $requestData): ?string
    {
        if (isset($requestData['transaction_id']) && !empty($requestData['transaction_id'])) {
            return $requestData['transaction_id'];
        }
        return null;
    }
}
