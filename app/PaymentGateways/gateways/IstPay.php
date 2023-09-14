<?php

namespace App\PaymentGateways\gateways;

use App\Enums\PixCashoutStatusEnum;
use App\Models\Transaction;
use App\PaymentGateways\interfaces\PixPaymentGatewayInterface;
use App\PaymentGateways\libs\IstPayApi;
use App\PaymentGateways\responses\PixCashoutInfoResponse;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositResponse;
use App\PaymentGateways\responses\PixDepositInfoResponse;
use App\PaymentGateways\traits\PaymentGatewayTrait;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Config\Definition\Exception\Exception;

class IstPay implements PixPaymentGatewayInterface
{
    private $api;
    use PaymentGatewayTrait;

    public function __construct()
    {
        $this->api = new IstPayApi();
    }

    public function newDeposit($value, $name, $document, $userId, $reference): PixDepositResponse
    {

        try {
            $response = $this->api->newDeposit($reference, $value, $name, $document);
            if ($response['response'] == 'OK') {
                $status = true;
                $qrcode_url = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='.$response['paymentCode'];
                $qrcode_content = $response['paymentCode'];
                $ref = $response['idTransaction'];
            } else {
                throw new \Exception("Deposit failed.");
            }
        } catch (\Exception) {
            $status = false;
            $qrcode_url = null;
            $qrcode_content = null;
            $ref = null;
        }

        //dd($status, $qrcode_url, $qrcode_content, $ref, $response);
        return $this->depositResponse($status, $qrcode_url, $qrcode_content, $ref);

    }

    public function requestCashout($pixKey, $doc, $value, $transactionId): PixCashoutResponse
    {
        try {
            $response = $this->api->requestWithdrawal($pixKey, $doc, $value, $transactionId);
            Log::info($response['ref']);
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
        $requirdIndexs = ['typeTransaction', 'statusTransaction', 'idTransaction'];
        hasAllIndexsOrFails($requestData, $requirdIndexs);
        $externalReference = $this->getReferenceFromRequest($requestData);
        if (!is_null($externalReference) && $requestData['typeTransaction'] == 'PIX_CASHOUT') {
            $status = null;
            if ($requestData['statusTransaction'] == 'PAID_OUT' || $requestData['statusTransaction'] == 'Aprovado') {
                $status = PixCashoutStatusEnum::Paid;
            } elseif ($requestData['statusTransaction'] == 'CANCELED' || $requestData['statusTransaction'] == 'Recusado') {
                $status = PixCashoutStatusEnum::Cancelled;
            }
            return $this->getCashoutInfoFromRequestResponse($status, $externalReference);
        } else {
            return $this->getCashoutInfoFromRequestResponse(null, null);
        }
    }

    public function getDepositInfoFromRequest(array $requestData): PixDepositInfoResponse
    {
        $requirdIndexs = ['type', 'idTransaction'];
        $externalReference = $this->getReferenceFromRequest($requestData);
        if (!is_null($externalReference) && $requestData['statusTransaction'] == 'PAID_OUT') {
            $isPaid = $this->api->isPaid($externalReference);
            return $this->getDepositInfoFromRequestResponse($isPaid, $externalReference);
        } else {
            return $this->getDepositInfoFromRequestResponse(false, null);
        }
    }

    public function getReferenceFromRequest(array $requestData): ?string
    {
        if (isset($requestData['idTransaction']) && !empty($requestData['idTransaction'])) {
            return $requestData['idTransaction'];
        }
        return null;
    }
}
