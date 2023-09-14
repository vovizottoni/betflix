<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use Cache;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Bet;
use App\Models\Bonus;
use App\Models\Account;


class Finance extends Component
{
    public $total_in_deposit = 0;
    public $total_withdraw = 0;
    public $total_account_balance = 0;

    public $total_bets = 0;
    public $total_payment_to_winners = 0;
    public $total_guaranteed_profit_percentage = [];

    public $total_bonus_paid = 0;
    public $total_bonus_bet = 0;
    public $total_bonus_home = 0;
    public $total_bonus_real_balance = 0;

    public $average_first_deposit_amount = 0;
    public $average_ticket_customer = 0;

    public function mount()
    {
        $this->total_in_deposit = $this->totalInDeposit();
        $this->total_withdraw = $this->totalWithdraw();
        $this->total_account_balance = $this->accountBalance();

        $this->total_bets = $this->bets();
        $this->total_payment_to_winners = $this->paymentToWinners();
        $this->total_guaranteed_profit_percentage = $this->guaranteedProfitPercentage();

        $this->total_bonus_paid = $this->bonusPaid();
        $this->total_bonus_bet = $this->bonusBet();
        $this->total_bonus_home = $this->bonusHome();
        $this->total_bonus_real_balance = $this->bonusRealBalance();

        $this->average_first_deposit_amount = $this->averageFirstDepositAmount();
        $this->average_ticket_customer = $this->averageTicketCustomer();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.finance');
    }

    public function filter($filterDate = false, $date = null)
    {
        $this->totalInDeposit($filterDate, $date);
        $this->totalWithdraw($filterDate, $date);
        $this->accountBalance($filterDate, $date);

        $this->bets($filterDate, $date);
        $this->paymentToWinners($filterDate, $date);
        $this->guaranteedProfitPercentage($filterDate, $date);

        $this->bonusPaid($filterDate, $date);
        $this->bonusBet($filterDate, $date);
        $this->bonusHome($filterDate, $date);
        $this->bonusRealBalance($filterDate, $date);

        $this->averageFirstDepositAmount($filterDate, $date);
        $this->averageTicketCustomer($filterDate, $date);
    }

    private function totalInDeposit($filterDate = false, $date = null)
    {
        $where = [];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $transaction = Transaction::where($where)->whereIn('type' , ['cashinPIX', 'cashinCC'])->where('status', '=', 'paid')->sum('amount');

        $this->total_in_deposit = $transaction;

        return $transaction;
    }

    private function totalWithdraw($filterDate = false, $date = null)
    {
        $where = [];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $transaction = Transaction::where($where)->whereIn('type' , ['cashoutPIX'])->where('status', '=', 'drawee')->sum('amount');

        $this->total_withdraw = $transaction;

        return $transaction;
    }

    private function accountBalance($filterDate = false, $date = null)
    {
        // se tiver filtro ocultar o campo. Ainda nao temos histórico de datas
        $accounts = Account::sum('balance');
        $this->total_account_balance = $accounts;

        return $accounts;
    }

    private function bets($filterDate = false, $date = null)
    {
        $where = [];
        $where[] = ['result', '!=', 'pending'];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $bet = Bet::where($where)->sum('amount');

        $this->total_bets = $bet;

        return $bet;
    }

    private function paymentToWinners($filterDate = false, $date = null)
    {
        $sql = "SELECT ( (amount * odd) - amount) as lucro from bets where `result` = 'green'";

        if(!empty($filterDate)){
            $sql .= " and created_at >= '".$date." 00:00:00'";
        }

        $bets = \DB::select($sql);
        $lucro = empty($bets[0])? 0 : $bets[0]->lucro;

        $this->total_payment_to_winners = $lucro;

        return $lucro;
    }

    private function guaranteedProfitPercentage($filterDate = false, $date = null)
    {
        $bets = $this->bets($filterDate, $date);
        $paymentToWinners = $this->paymentToWinners($filterDate, $date);

        $total = $bets - $paymentToWinners;
        $percentage = empty($bets)? 0 : ($bets - $paymentToWinners) / $bets;

        $arrResult = [
            'total' => $total,
            'percentage' => $percentage
        ];

        $this->total_guaranteed_profit_percentage = $arrResult;

        return $arrResult;
    }

    private function bonusPaid($filterDate = false, $date = null)
    {
        $where = [];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $bonus = Bonus::where($where)->sum('amount');

        $this->total_bonus_paid = $bonus;

        return $bonus;
    }

    private function bonusBet($filterDate = false, $date = null)
    {
        $where = [];
        $where[] = ['balance_used', '=', 'balanceBonus'];
        $where[] = ['result', '!=', 'pending'];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $bet = Bet::where($where)->sum('amount');

        $this->total_bonus_bet = $bet;

        return $bet;
    }

    private function bonusHome($filterDate = false, $date = null)
    {
        // se tiver filtro ocultar o campo. Ainda nao temos histórico de datas
        $accounts = Account::sum('balanceBonus');
        $this->total_bonus_home = $accounts;

        return $accounts;
    }

    private function bonusRealBalance($filterDate = false, $date = null)
    {
        $sql = "SELECT ( (amount * odd) - amount) as lucro from bets where `result` = 'green' and balance_used = 'balanceBonus'";

        if(!empty($filterDate)){
            $sql .= " and created_at >= '".$date." 00:00:00'";
        }

        $bets = \DB::select($sql);
        $lucro = empty($bets[0])? 0 : $bets[0]->lucro;

        $this->total_bonus_real_balance = $lucro;

        return $lucro;
    }

    private function averageFirstDepositAmount($filterDate = false, $date = null)
    {
        $where = [];

        if(!empty($filterDate)){
            $where[] = ['created_at', '>=', $date . '00:00:00'];
        }

        $transactions = Transaction::where($where)->get();

        $dataTransaction = [];
        $sumAmount = 0;
        foreach($transactions as $item){
            if(! array_key_exists($item->accounts_id, $dataTransaction)){
                $sumAmount += $item->amount;
                $dataTransaction[$item->accounts_id] = $item->amount;
            }
        }

        $total = 0;
        if(count($dataTransaction) > 0)
            $total = $sumAmount / count($dataTransaction);

        $this->average_first_deposit_amount = $total;

        return $total;
    }

    private function averageTicketCustomer($filterDate = false, $date = null)
    {
        $sql = "SELECT count(*) as total,
                sum(t.amount) as amount
                from transactions t
                inner join accounts a on a.id = t.accounts_id
                inner join users u on u.id = a.users_id
                where t.type in('cashinPIX','cashinCC')
                and t.status = 'paid'";

        if(!empty($filterDate)){
            $sql .= " and t.created_at >= '".$date." 00:00:00'";
        }

        $transactions = \DB::select($sql);

        $total = empty($transactions[0])? 0 : $transactions[0]->total;
        $amount = empty($transactions[0])? 0 : $transactions[0]->amount;

        $ticket = 0;
        if($total > 0){
            $ticket = $amount / $total;
        }

        $this->average_ticket_customer = $ticket;

        return $ticket;
    }
}
