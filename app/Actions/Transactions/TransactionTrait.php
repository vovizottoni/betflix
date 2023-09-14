<?php

namespace App\Actions\Transactions;

use App\Enums\BalanceUsedEnum;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Events\ConfirmedDeposit;
use App\Events\DepositRequest;
use App\Exceptions\SoftException;
use App\Helpers\PagStarApi;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

trait TransactionTrait
{

    private function addDepositBalance(Transaction $transaction, Account $account)
    {
        bcscale(2);
        //verifica qual o balance_used da $transaction->id
        $balanceUsedName = $transaction->balance_used;
        if (isset($account[$balanceUsedName])) { //BRL
            $account->addBalance($balanceUsedName, $transaction->amount, $transaction->getCode());
            return true;
        } else {
            return false;
        }

    }


}
