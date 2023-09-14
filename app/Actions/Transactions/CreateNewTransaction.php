<?php

namespace App\Actions\Transactions;

use App\Enums\TransactionStatus;
use App\Models\Transaction;

class CreateNewTransaction
{
    public function action($accountId, $type, $amount, $reference, $extra_data = [], $balance_used = "balance")
    {
        $transaction = new Transaction();
        $transaction->accounts_id = $accountId;
        $transaction->type = $type;
        $transaction->status = TransactionStatus::WaitingForPayment;
        $transaction->amount = $amount;
        $transaction->external_reference = $reference;
        $transaction->transaction_code = getUniqueCode();
        $transaction->balance_used = $balance_used;
        $transaction->extra_data = json_encode($extra_data);
        $transaction->saveOrFail();
        return $transaction;
    }
}
