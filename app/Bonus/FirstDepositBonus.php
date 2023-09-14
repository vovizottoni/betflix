<?php

namespace App\Bonus;

use App\Enums\TransactionDepositBonusStatus;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class FirstDepositBonus
{
    public function pay(Transaction $transaction)
    {
        try {
            DB::beginTransaction();
            if ($transaction->deposit_bonus_status != TransactionDepositBonusStatus::Pending) {
                throw new \Exception("Bonus already paid.");
            }
            $bonus = new Bonus2($transaction);
            $bonus->pay();
            $transaction->deposit_bonus_status = TransactionDepositBonusStatus::Pending;
            $transaction->saveOrFail();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage() . ':' . $e->getFile() . ":" . $e->getLine());
        }

    }
}