<?php

namespace App\Http\Livewire\Admin\Transactions\CashoutPagstar;

use App\Exceptions\SoftException;
use App\Http\Controllers\Controller;
use App\Jobs\PayAdminPixWithdraw;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class CashoutApprovalActions extends Controller
{
    public function cashoutApproved($transaction_id)
    {
        # Init transaction
        \DB::beginTransaction();

        try {
            # Get Transaction
            $transaction = Transaction::where([['id', '=', $transaction_id]])->first();

            if (!$transaction->canBeManualPaid()) {
                throw new \Exception("Withdrawal not enabled for manual payment.");
            }

            $transaction->cashout_approval = 'approved';
            $transaction->saveOrFail();

            dispatch(new PayAdminPixWithdraw($transaction));

            \DB::commit();
            session()->flash('message_suscess_approval', 'Saque aprovado e em andamento');
        } catch (SoftException $e) {

            \DB::rollback();
            session()->flash('error', $e->getMessage());
        } catch (\Exception $e) {

            \DB::rollback(); 
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('admin.cashout-pagstar.cashout-approval');
    }

    public function cashoutDenied(Request $request, $transaction_id)
    {
        # Init transaction
        \DB::beginTransaction();

        try {

            if ($request->input('type_reversal') === "1") {

                Transaction::where([['id', '=', $transaction_id]])->update(['status' => 'canceled', 'cashout_approval' => 'denied']);

                session()->flash('message_suscess_denied', 'Saque negado e cancelado');
            }
            if ($request->input('type_reversal') === "2") {

                $transaction = Transaction::where([['id', '=', $transaction_id]])->first();
                $account = Account::where([['id', '=', $transaction->account->id]])->first();

                $current_balance = (string)$account->balance;
                $destiny = 'balance';

                if ($transaction->balance_used == 'balanceBonus') {
                    $current_balance = (string)$account->balanceBonus;
                    $destiny = 'balanceBonus';
                }

                $new_balance = bcadd($current_balance, (string)$transaction->amount, 2);

                Account::where([['id', '=', $account->id]])->update([$destiny => $new_balance]);
                Transaction::where([['id', '=', $transaction_id]])->update(['status' => 'canceled', 'cashout_approval' => 'denied']);

                session()->flash('message_suscess_denied', 'Saque negado e cancelado, estorno realizado');
            }

            \DB::commit();
        } catch (\Exception $e) {

            \DB::rollback();
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('admin.cashout-pagstar.cashout-approval');
    }
}
