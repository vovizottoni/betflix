<?php

namespace App\Actions\Transactions;

use App\Enums\TransactionDepositBonusStatus;
use App\Enums\TransactionStatus;
use App\Events\ConfirmedDeposit;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ConfirmDeposit
{
    use TransactionTrait;

    public function action(int $transactionId): ?Transaction
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::whereId($transactionId)->incompleDeposits()->first();
            if (!isset($transaction['id'])) {
                throw new \Exception("Deposit not found.");
            }
            //Adiciona Saldo para a conta associada a $transaction
            $account = $transaction->account()->first();
            $accountOwner = $account->user()->first();
            //Pagamento confirmado pela API Pagstar (atualiza no BD)
            $newStatus = TransactionStatus::Paid;
            $transaction->status = $newStatus;
            $transaction->saveOrFail();
            $firstDeposit = $accountOwner->getFirstDeposit();

            if ($firstDeposit['id'] == $transaction->id) {
                $transaction->deposit_bonus_status = TransactionDepositBonusStatus::Pending;
                $transaction->is_first_deposit = true;
                $transaction->saveOrFail();
            }

            $this->addDepositBalance($transaction, $account);
            ConfirmedDeposit::dispatch($transaction);
            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return null;
    }
}
