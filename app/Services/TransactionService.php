<?php

namespace App\Services;

use App\Enums\BalanceUsedEnum;
use App\Enums\FungamesEventType;
use App\Enums\PaymentGatewaysEnum;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Events\BetLoseEvent;
use App\Events\BetWinEvent;
use App\Events\ConfirmedDeposit;
use App\Events\DepositRequest;
use App\Exceptions\DailyCashoutLimitException;
use App\Exceptions\InsufficientFundsException;
use App\Exceptions\MinMaxCashoutException;
use App\Exceptions\SoftException;
use App\Helpers\FastPaymentsApi;
use App\Helpers\PagStarApi;
use App\Jobs\PayPixWithdraw;
use App\Models\Account;
use App\Models\FungamessGameGains;
use App\Models\Transaction;
use App\PaymentGateways\PixPaymentGateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class TransactionService
{


    public function processWithDrawal(Account $account, $document, float $amount, $forceIgnoredJob = false, $pixKey = null, $accountOwnerName = null)
    {
        DB::transaction(function () use ($account, $document, $amount, $forceIgnoredJob, $pixKey, $accountOwnerName) {
            if (is_null($pixKey)) {
                $pixKey = getOnlyNumbers($pixKey);
            }
            $minWtd = env("MIN_AMOUNT_WITHDRAW_PIX_BRL");
            $maxWtd = env("MAX_AMOUNT_WITHDRAW_PIX_BRL");
            
            $balanceName = BalanceUsedEnum::Balance;
            $balance = $account->{$balanceName};

            if ($amount > $balance) {
                throw new InsufficientFundsException();
            }

            if ($amount > $maxWtd || $minWtd > $amount) {
                throw new MinMaxCashoutException();
            }

            $dailyLimit = (int)getMetaValue('number_of_withdraws_per_day');
            $user = $account->user()->first();
            $countCashoutToday = $user->qtyCashoutToday();

            if ($countCashoutToday >= $dailyLimit) {
                throw new DailyCashoutLimitException();
            }
            $MAX_AMOUNT_CASHOUT_AUTOMATIC_APPROVAL = (float)getMetaValue("max_amount_cashout_automatic_approval");
            $transaction_code______ = getUniqueCode();
            $transactionCode = strtolower(TransactionType::CashoutPIX) . '_' . $transaction_code______;
            $account = $account->removeBalanceAndCheckfunds($balanceName, $amount, $transactionCode);

            $transactionData = ['accounts_id' => $account->id,
                'type' => TransactionType::CashoutPIX,
                'status' => TransactionStatus::WaitingForPayment,
                'amount' => $amount,
                'external_reference' => $pixKey,
                'balance_used' => $balanceName,
                'transaction_code' => $transaction_code______
            ];
            if ($amount > $MAX_AMOUNT_CASHOUT_AUTOMATIC_APPROVAL) {
                $autoPay = false;
            } else {
                $autoPay = true;
            }
            if (is_null($accountOwnerName)) {
                $accountOwnerName = $user->name;
            }
            $extraData = ['name' => encrypt($accountOwnerName), 'document' => encrypt($document), 'pix_key' => encrypt($pixKey), 'amount' => encrypt($amount)];
            $extraData['auto_pay'] = $autoPay;
            if ($autoPay) {
                $extraData['job'] = false;
            } else {
                $transactionData['status'] = TransactionStatus::WaitingForWithdraw;
                $transactionData['cashout_approval'] = 'waiting_for_approval';
            }
            $transactionData['extra_data'] = json_encode($extraData);
            $transactionData = Transaction::create($transactionData);
            if (!isset($transactionData['id'])) {
                throw new \Exception("Database fail.");
                
            }
            if ($autoPay && $forceIgnoredJob === false) {
                dispatch(new PayPixWithdraw($transactionData))->afterCommit();
            }
        });


    }

    public function payPixWithdrawal(Transaction $transaction)
    {

        try {
            $extraData = $transaction->getExtraDataAsArray();
            //$gatewayName = PaymentGatewaysEnum::PagStar;
            $gatewayName = PaymentGatewaysEnum::IstPay;

            $gateway = new PixPaymentGateway($gatewayName);
            $response = $gateway->requestWithdrawal($transaction);
            Log::info(json_encode($response));
            Log::info(json_encode($response->getRef()));
            
            if ($response->getStatus()) {
                $transaction->external_reference = $response->getRef();
                $transaction->saveOrFail();
                $extraData['job'] = true;
                $extraData['gateway'] = $gatewayName;
                $transaction->updateExtraData($extraData);
            } else {
                $extraData['job'] = true;
                $extraData['compliance'] = true;
                $transaction->updateExtraData($extraData);
                throw new \Exception("Compliance Exception.");
            }

        } catch (\Exception $e) {
            $transaction->cancell();
        }

    }


}
