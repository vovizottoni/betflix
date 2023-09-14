<?php

namespace App\Actions\Transactions;

use App\Enums\BalanceUsedEnum;
use App\Enums\PaymentGatewaysEnum;
use App\Enums\TransactionType;
use App\Events\DepositRequest;
use App\Exceptions\SoftException;
use App\Helpers\FastPaymentsApi;
use App\Helpers\PagStarApi;
use App\Models\Account;
use App\Models\Transaction;
use App\PaymentGateways\PixPaymentGateway;

class CreateNewCashin
{
    use TransactionTrait;

    public function action(Account $account, $type, $value, $name, $document, $rollOver = false): ?Transaction
    {
        if ($type == TransactionType::CashinPIX) {
            $user = $account->user()->first();

            //$gatewayName = PaymentGatewaysEnum::FastPayments;
            //$gatewayName = PaymentGatewaysEnum::PagStar;
            $gatewayName = PaymentGatewaysEnum::IstPay;
            
            $gateway = new PixPaymentGateway($gatewayName);
            $reference = getUniqueCode();
            $response = $gateway->newDeposit($value, $name, $document, $user->id, $reference);
            if ($response->hasQrcode()) {
                $externalReference = $response->getRef();
                $qrCodeUrl = $response->getQrCodeUrl();
                $qrCodeContent = $response->getQrCodeContent();
                $extraData = [
                    'name' => $user->name,
                    'account_id_name' => $account->name,
                    'value_' => $value,
                    'pixkey' => $document,
                    'pix_qr_code_url' => $qrCodeUrl,
                    'pix_code' => $qrCodeContent,
                    'gateway' => $gatewayName
                ];
                $createTransaction = new CreateNewTransaction();
                $transaction = $createTransaction->action($account->id, TransactionType::CashinPIX, $value,
                    $externalReference, $extraData, BalanceUsedEnum::Balance
                );
                DepositRequest::dispatch($transaction);
                return $transaction;
            }

        }
        throw new SoftException(__('cashin.pix_faild'));
    }
}
