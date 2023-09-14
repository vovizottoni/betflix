<?php

namespace App\PaymentGateways;

use App\Actions\Transactions\ConfirmDeposit;
use App\Enums\PaymentGatewaysEnum;
use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\PaymentGateways\gateways\PagStar;
use App\Helpers\ValidaCPFCNPJ;
use App\PaymentGateways\gateways\IstPay;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositResponse;

class PixPaymentGateway
{
    private $gateway;

    public function __construct($gatewayName)
    {
        switch ($gatewayName) {
            case PaymentGatewaysEnum::PagStar:
                $this->gateway = new PagStar();
                break;

            case PaymentGatewaysEnum::IstPay:
                $this->gateway = new IstPay();
                break;
            default:
                throw new \Exception("Invalid gateway");
                break;
        }

        // if ($gatewayName == PaymentGatewaysEnum::PagStar) {
        //     $this->gateway = new PagStar();
        // } else {
        //     throw new \Exception("Invalid gateway");
        // }
    }

    public function newDeposit($value, $name, $document, $userId, $reference): PixDepositResponse
    {
        return $this->gateway->newDeposit($value, $name, $document, $userId, $reference);
    }

    public function requestWithdrawal(Transaction $transaction): PixCashoutResponse
    {
        $transactionId = $transaction->transaction_code;
        $transaction = Transaction::where("transaction_code", $transactionId)->isCashout()->firstOrFail();
        $extraData = $transaction->getExtraDataAsArray();
        $doc = decrypt($extraData['document']);
        $pixKey = decrypt($extraData['pix_key']);
        $value = decrypt($extraData['amount']);
        $rule = new ValidaCPFCNPJ($pixKey);
        if ($rule->valida()) {
            $pixKey = $rule->formata();
        } else if (validaTelefone($pixKey)) {
            $pixKey = "+55" . getOnlyNumbers($pixKey);
        }
        if (inLocalEnvironment()) {
            $value = 0.21;
        }

        return $this->gateway->requestCashout($pixKey, $doc, $value, $transactionId);
    }

    public function getReferenceFromRequest(array $requestData): ?string
    {
        return $this->gateway->getReferenceFromRequest($requestData);
    }

    public function proccessDepositWebhook(array $requestData)
    {
        $externalReference = $this->gateway->getReferenceFromRequest($requestData);
        $transaction = Transaction::whereExternalReference($externalReference)->incompleDeposits()->firstOrFail();
        $basicInfo = $this->gateway->getDepositInfoFromRequest($requestData);
        if ($basicInfo->isPaid()) {
            $confirmDeposit = new ConfirmDeposit();
            $confirmDeposit->action($transaction['id']);
        }
    }

    public function proccessCashoutWebhook(array $requestData)
    {
        $externalReference = $this->gateway->getReferenceFromRequest($requestData);
        $transaction = Transaction::whereExternalReference($externalReference)->isPixPendingCashout()->firstOrFail();
        $basicInfo = $this->gateway->getCashoutInfoFromRequest($requestData);
        if ($basicInfo->isPaid()) {
            $transaction->status = TransactionStatus::Drawee;
            $transaction->saveOrFail();
        } else if ($basicInfo->isCancelled()) {
            $transaction->cancell();
        }
    }
}
