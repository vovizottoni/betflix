<?php

namespace App\Http\Livewire\Admin;

use App\Models\Account;
use App\Models\Bet;
use App\Models\Bonus;
use App\Models\FungamessGameGains;
use App\Models\FungamessGames;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $total_bets;

    public $total_guaranteed_profit_percentage = [];
    public $total_payment_to_winners;
    public $total_in_deposit = 0;
    public $total_withdraw = 0;
    public $total_withdraw_in_order = 0;
    public $total_bonus_paid = 0;
    public $total_bonus_payable = 0;
    public $average_first_deposit_amount = 0;
    public $average_cashout_amount = 0;
    public $average_ticket_customer = 0;
    public $guaranteed_bonus = 0;
    public $balance_bonus = 0;
    public $balance_total = 0;
    public $balance_total_users = 0;
    public $balance_total_affiliates = 0;

    public function mount(){
        //GGR
        $this->total_guaranteed_profit_percentage = $this->guaranteedProfitPercentage();
        //DEPOSITOS
        $this->total_in_deposit = $this->totalInDeposit();
        //SAQUES
        $this->total_withdraw = $this->totalWithdraw();
        $this->total_withdraw_in_order = $this->total_withdraw_in_order();
        //BÔNUS
        $this->total_bonus_paid = $this->bonusPaid();
        $this->total_bonus_payable = $this->bonus_payable();
        //MEDIAS
        $this->average_first_deposit_amount = $this->averageDepositAmount();
        $this->average_cashout_amount = $this->averageCashoutAmount();
        $this->average_ticket_customer = $this->averageTicketCustomer();
        //DADOS DE BONUS(BOAS VINDAS)
        $this->guaranteed_bonus = $this->guaranteedBonus();
        $this->balance_bonus = $this->balanceBonus();
        //SALDOS
        $this->balance_total = $this->balanceTotal();
        $this->balance_total_users = $this->balanceTotalUsers();
        $this->balance_total_affiliates = $this->balanceTotalAffiliates();




    }



    private function bets()
    {
        $bet_hypetech = Bet::sum('amount');
        $bet_fungames = FungamessGameGains::sum('amount');

        $bet = $bet_hypetech + $bet_fungames;
        $this->total_bets = $bet;

        return $bet;
    }

    private function paymentToWinners()
    {
        $sql = "SELECT ( (amount * odd) - amount) as lucro from bets where `result` = 'green'";


        $bets = \DB::select($sql);
        $lucro = empty($bets[0])? 0 : $bets[0]->lucro;

        $this->total_payment_to_winners = $lucro;

        return $lucro;
    }

    private function guaranteedProfitPercentage()
    {
        $bets = $this->bets();
        $paymentToWinners = $this->paymentToWinners();

        $total = $bets - $paymentToWinners;
        $percentage = empty($bets)? 0 : ($bets - $paymentToWinners) / $bets;

        $arrResult = [
            'total' => $total,
            'percentage' => $percentage
        ];

        $this->total_guaranteed_profit_percentage = $arrResult;

        return $arrResult;
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

    private function totalWithdraw()
    {

        $transaction = Transaction::whereIn('type' , ['cashoutPIX'])->where('status', '=', 'drawee')->sum('amount');



        return $transaction;
    }

    private function total_withdraw_in_order()
    {

        $transaction_in_order = Transaction::whereIn('type' , ['cashoutPIX'])->where('status', '=', 'waiting_for_payment')->sum('amount');


        $this->total_withdraw_in_order = $transaction_in_order;

        return $transaction_in_order;
    }

    private function bonusPaid()
    {

        $bonus_paid = Bonus::where('pagou','=','s')->sum('amount');

        $this->total_bonus_paid = $bonus_paid;


        return $bonus_paid;
    }

    private function bonus_payable()
    {

        $bonus_payable = Bonus::where('pagou','=','n')->sum('amount');

        $this->total_bonus_payable = $bonus_payable;

        return $bonus_payable;
    }


    private function averageDepositAmount()
    {

        $transaction = Transaction::whereIn('type' , ['cashinPIX'])->where('status', '=', 'paid')->get();

        $dataTransaction = [];
        $sumAmount = 0;
        foreach($transaction as $item){
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

    private function averageCashoutAmount()
    {

        $transaction = Transaction::whereIn('type' , ['cashoutPIX'])->where('status', '=', 'drawee')->get();

        $dataTransaction = [];
        $sumAmount = 0;
        foreach($transaction as $item){
            if(! array_key_exists($item->accounts_id, $dataTransaction)){
                $sumAmount += $item->amount;
                $dataTransaction[$item->accounts_id] = $item->amount;
            }
        }

        $total_deposit = 0;
        if(count($dataTransaction) > 0)
            $total_deposit = $sumAmount / count($dataTransaction);

        $this->average_cashout_amount = $total_deposit;

        return $total_deposit;
    }

    private function averageTicketCustomer()
    {
        $sql = "SELECT count(*) as total,
                sum(t.amount) as amount
                from transactions t
                inner join accounts a on a.id = t.accounts_id
                inner join users u on u.id = a.users_id
                where t.type in('cashinPIX','cashinCC')
                and t.status = 'paid'";


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

    private function guaranteedBonus()
    {

        $guaranteedbonus = Bonus::sum('amount');

        $this->guaranteed_bonus = $guaranteedbonus;


        return $guaranteedbonus;
    }

    private function balanceBonus()
    {

        $balanceBonus = Account::sum('balanceBonus');

        $this->balance_bonus = $balanceBonus;

        return $balanceBonus;
    }

    private function balanceTotal()
    {

        $balanceTotal = Account::sum('balance');

        $this->balance_total = $balanceTotal;

        return $balanceTotal;
    }

    private function balanceTotalUsers()
    {
        $users = User::whereNull('bonus3_nivelhierarquico')->pluck('id');
        $balanceTotalUsers = Account::whereIn('users_id', $users)->sum('balance');

        $this->balance_total_users = $balanceTotalUsers;

        return $balanceTotalUsers;

    }

    private function balanceTotalAffiliates()
    {
        $users = User::whereNotNull('bonus3_nivelhierarquico')->pluck('id');
        $balanceTotalAffiliates = Account::whereIn('users_id', $users)->sum('balance');

        $this->balance_total_affiliates = $balanceTotalAffiliates;

        return $balanceTotalAffiliates;

    }



    public function render()
    {
        return view('livewire.admin.home');
    }
}
