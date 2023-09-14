<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Account;
use App\Models\Bet;
use App\Models\Bonus;
use App\Models\FungamessGameGains;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Livewire\WithPagination;
use Yajra\DataTables\DataTables;

class HomeIndicadores extends Component
{
    use WithPagination;

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
    public $pay_bets = 0;
    public $ggr = [];
    public $guaranteed_bonus = 0;
    public $balance_bonus = 0;
    public $balance_total = 0;
    public $balance_available = 0;
    public $balance_total_users = 0;
    public $balance_total_affiliates = 0;
    public $net_gaming_revenue = 0;
    public $total_financial_taxes = 0;
    public $total_provider_taxes;
    public $usersPerDay = [];
    public $affiliatesPerDay = [];
    public $depositsPerDay = [];
    public $depositstotal = [];
    public $firstdepositsPerday = [];
    public $firstdeposits = [];
    public $bonus_cpa = [];
    public $bonus_rev = [];
    public $cashout = [];
    public $count_cashout = [];
    public $cashout_affiliates = [];
    public $cashout_affiliates_count = [];
    public $providers_taxes = [];




    public function mount()
    {
        //dd($this->ggr['total']);
        //GGR
        $this->total_guaranteed_profit_percentage = $this->guaranteedProfitPercentage();
        //NGR
        $this->net_gaming_revenue = $this->netGamingRevenue();
        //TAXAS
        $this->total_financial_taxes = $this->financialTaxes();
        $this->total_provider_taxes = $this->providersTaxes();
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
        $this->balance_available = $this->balanceAvailable();
        $this->balance_total_users = $this->balanceTotalUsers();
        $this->balance_total_affiliates = $this->balanceTotalAffiliates();
        $this->ggr = $this->calculateGGR();

        //LIVRO CAIXA
        $users = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->orderBy('date', 'desc')
            ->groupBy('date')
            ->take(3);
        $this->usersPerDay = $users->pluck('count', 'date')->toArray();

        $affiliates = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count_affiliates'))
            ->whereNotNull('bonus3_nivelhierarquico')
            ->groupBy('date')
            ->get();

        $this->affiliatesPerDay = $affiliates->pluck('count_affiliates', 'date')->toArray();
        //NUMERO DE DEPOSITOS POR DIA
        $depositsPerday = Transaction::whereIn('type', ['cashinPIX'])
            ->where('status', '=', 'paid')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_perday'))
            ->groupBy('date')
            ->get();
        $this->depositsPerDay = $depositsPerday->pluck('total_perday', 'date')->toArray();

        // Obter os depósitos por dia
        $deposits = Transaction::whereIn('type', ['cashinPIX'])
            ->where('status', '=', 'paid')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->depositstotal = $deposits->pluck('total_amount', 'date')->toArray();



        //PRIMEIROS DEPOSITOS
        $firstdepositsPerday = Transaction::whereIn('type', ['cashinPIX'])
            ->where('status', '=', 'paid')
            ->where('is_first_deposit', '=', 1)
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_perday'))
            ->groupBy('date')
            ->get();
        $this->firstdepositsPerday = $firstdepositsPerday->pluck('total_perday', 'date')->toArray();


        $firstdeposits = Transaction::whereIn('type', ['cashinPIX'])
            ->where('status', '=', 'paid')
            ->where('is_first_deposit', '=', 1)
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->firstdeposits = $firstdeposits->pluck('total_amount', 'date')->toArray();

        //PAGOS EM CPA

        $bonus_cpa = Bonus::where('group_tipo', '=', '2')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->bonus_cpa = $bonus_cpa->pluck('total_amount', 'date')->toArray();

        //REV
        $bonus_rev = Bonus::where('group_tipo', '=', '3')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->bonus_rev = $bonus_rev->pluck('total_amount', 'date')->toArray();

        //SAQUES
        $cashout = Transaction::whereIn('type', ['cashoutPIX'])
            ->where('status', '=', 'drawee')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->cashout = $cashout->pluck('total_amount', 'date')->toArray();

        $count_cashout = Transaction::whereIn('type', ['cashoutPIX'])
            ->where('status', '=', 'drawee')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count_cashout'))
            ->groupBy('date')
            ->get();
        $this->count_cashout = $count_cashout->pluck('count_cashout', 'date')->toArray();

        //SAQUES AFILIADOS

        $users_id_affiliates = User::whereNotNull('bonus3_nivelhierarquico')->pluck('id')->toArray();
        $accounts_affiliates = Account::whereIn('users_id', $users_id_affiliates)->pluck('id')->toArray();
        $cashout_affiliates = Transaction::whereIn('type', ['cashoutPIX'])
            ->whereIn('accounts_id', $accounts_affiliates)
            ->where('status', '=', 'drawee')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();

        $this->cashout_affiliates = $cashout_affiliates->pluck('total_amount', 'date')->toArray();

        $cashout_affiliates_count = Transaction::whereIn('type', ['cashoutPIX'])
            ->whereIn('accounts_id', $accounts_affiliates)
            ->where('status', '=', 'drawee')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count_cashout'))
            ->groupBy('date')
            ->get();

        $this->cashout_affiliates_count = $cashout_affiliates_count->pluck('count_cashout', 'date')->toArray();

        //TAXA PROVEFORA

        $providers_taxes = FungamessGameGains::where('event_type', '=', 'Lose')
            ->whereNotNull('created_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        $this->providers_taxes = $providers_taxes->pluck('total_amount', 'date')->toArray();
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
        $sql = "SELECT
        ((b.amount * b.odd) - b.amount) AS lucro_hypetech,
        (fg.aposta - fg.win) AS lucro_fungames,
        ((b.amount * b.odd) - b.amount + fg.aposta - fg.win) AS lucro
    FROM bets AS b
    CROSS JOIN (
        SELECT
            SUM(CASE WHEN event_type = 'BetPlacing' THEN amount ELSE 0 END) AS aposta,
            SUM(CASE WHEN event_type = 'Win' THEN amount ELSE 0 END) AS win
        FROM fungamess_game_gains
    ) AS fg
    WHERE b.`result` = 'green'";

        $bets = \DB::select($sql);
        $lucro = empty($bets[0]) ? 0 : $bets[0]->lucro;

        $this->total_payment_to_winners = $lucro;

        return $lucro;
    }

    public function payBets()
    {
        $pay_amount = Bet::where('result', 'green')
        ->selectRaw('SUM(amount * (odd - 1)) as pay_amount')
        ->value('pay_amount');

        $pay_amount_fungames_amount = FungamessGameGains::where('event_type','BetPlacing')->select('amount')->sum('amount');
        $pay_amount_fungames_win = FungamessGameGains::where('event_type','Win')->select('amount')->sum('amount');
        $pay_total = $pay_amount + $pay_amount_fungames_amount + $pay_amount_fungames_win;
        $this->pay_bets = $pay_total;

        return $pay_total;
    }

    private function calculateGGR()
    {
        $totalBets_fg = FungamessGameGains::select('amount')->sum('amount');
        $totalBets_ht = Bet::select('amount')->sum('amount'); // Valor total das apostas realizadas

        $totalBets = $totalBets_fg + $totalBets_ht;

        $totalWinningBets = $this->payBets();
        $ggr = $totalBets - $totalWinningBets;

        $ggrPercentage = ($ggr / $totalBets) * 100; // Cálculo da porcentagem do GGR

        $arrResult = [
            'total' => $ggr,
            'percentage' => $ggrPercentage
        ];
        $this->ggr = $arrResult;

        return $arrResult;
    }

    private function guaranteedProfitPercentage()
    {
        $bets = $this->bets();
        $paymentToWinners = $this->paymentToWinners();

        $total = $bets - $paymentToWinners;
        $percentage = empty($bets) ? 0 : ($bets - $paymentToWinners) / $bets;

        $arrResult = [
            'total' => $total,
            'percentage' => $percentage
        ];

        $this->total_guaranteed_profit_percentage = $arrResult;

        return $arrResult;
    }

    private function netGamingRevenue()
    {
        $ggrData = $this->calculateGGR();
        $totalGGR = $ggrData['total'];
        $rev_affiliates = Bonus::where('group_tipo', '=', '3')->sum('amount');


        $rev_provdoras = 0.15 * $totalGGR;

        $ngr = $totalGGR - ($rev_affiliates + $rev_provdoras);


        $percentage_ngr = empty($totalGGR) ? 0 : ($ngr / $totalGGR) * 100;

        $arrResult_ngr = [
            'total' => $ngr,
            'percentage' => $percentage_ngr
        ];

        $this->net_gaming_revenue = $arrResult_ngr;

        return $arrResult_ngr;
    }

    private function totalInDeposit()
    {

        $transaction = Transaction::whereIn('type', ['cashinPIX', 'cashinCC'])->where('status', '=', 'paid')->sum('amount');

        $this->total_in_deposit = $transaction;

        return $transaction;
    }

    private function totalWithdraw()
    {

        $transaction = Transaction::whereIn('type', ['cashoutPIX'])->where('status', '=', 'drawee')->sum('amount');



        return $transaction;
    }

    private function total_withdraw_in_order()
    {

        $transaction_in_order = Transaction::whereIn('type', ['cashoutPIX'])->where('status', '=', 'waiting_for_payment')->sum('amount');


        $this->total_withdraw_in_order = $transaction_in_order;

        return $transaction_in_order;
    }

    private function bonusPaid()
    {

        $bonus_paid = Bonus::where('pagou', '=', 's')->sum('amount');

        $this->total_bonus_paid = $bonus_paid;


        return $bonus_paid;
    }

    private function bonus_payable()
    {

        $bonus_payable = Bonus::where('pagou', '=', 'n')->sum('amount');

        $this->total_bonus_payable = $bonus_payable;

        return $bonus_payable;
    }

    private function financialTaxes()
    {

        $cashout = Transaction::whereIn('type', ['cashoutPIX'])->where('status', '=', 'drawee')->sum('amount');
        $cashin = Transaction::whereIn('type', ['cashinPIX'])->where('status', '=', 'paid')->sum('amount');
        $taxes = 0.03 * ($cashout + $cashin);


        $this->total_financial_taxes = $taxes;

        return $taxes;
    }


    private function providersTaxes()
    {
        $ggrData = $this->calculateGGR();
        $totalGGR = $ggrData['total'];

        $rev_providers = $totalGGR * 0.15;



        $this->total_provider_taxes = $rev_providers;

        return $rev_providers;
    }




    private function averageDepositAmount()
    {

        $transaction = Transaction::whereIn('type', ['cashinPIX'])->where('status', '=', 'paid')->get();

        $dataTransaction = [];
        $sumAmount = 0;
        foreach ($transaction as $item) {
            if (!array_key_exists($item->accounts_id, $dataTransaction)) {
                $sumAmount += $item->amount;
                $dataTransaction[$item->accounts_id] = $item->amount;
            }
        }

        $total = 0;
        if (count($dataTransaction) > 0)
            $total = $sumAmount / count($dataTransaction);

        $this->average_first_deposit_amount = $total;

        return $total;
    }

    private function averageCashoutAmount()
    {

        $transaction = Transaction::whereIn('type', ['cashoutPIX'])->where('status', '=', 'drawee')->get();

        $dataTransaction = [];
        $sumAmount = 0;
        foreach ($transaction as $item) {
            if (!array_key_exists($item->accounts_id, $dataTransaction)) {
                $sumAmount += $item->amount;
                $dataTransaction[$item->accounts_id] = $item->amount;
            }
        }

        $total_deposit = 0;
        if (count($dataTransaction) > 0)
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

        $total = empty($transactions[0]) ? 0 : $transactions[0]->total;
        $amount = empty($transactions[0]) ? 0 : $transactions[0]->amount;

        $ticket = 0;
        if ($total > 0) {
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
        $balanceBonus = 0;
        $chunkSize = 1000; // Tamanho do lote

        Account::chunk($chunkSize, function ($accounts) use (&$balanceBonus) {
            $balanceBonus += $accounts->sum('balanceBonus');
        });

        $this->balance_bonus = $balanceBonus;

        return $balanceBonus;
    }

    private function balanceTotal()
    {
        $balanceTotal = 0;
        $chunkSize = 1000; // Tamanho do lote

        Account::chunk($chunkSize, function ($accounts) use (&$balanceTotal) {
            $balanceTotal += $accounts->sum('balance');
        });

        $this->balance_total = $balanceTotal;

        return $balanceTotal;
    }

    private function balanceAvailable()
    {
        $balanceAvailable = 0;
        $chunkSize = 1000; // Tamanho do lote

        Account::chunk($chunkSize, function ($accounts) use (&$balanceAvailable) {
            $balanceAvailable += $accounts->where('balance', '>=' ,'90')->sum('balance');
        });

        $this->balance_available = $balanceAvailable;

        return $balanceAvailable;
    }

    private function balanceTotalUsers()
    {
        $users = User::whereNull('bonus3_nivelhierarquico')->pluck('id');
        $userChunks = $users->chunk(1000); // Dividir os IDs dos usuários em lotes de 1000

        $balanceTotalUsers = 0;

        foreach ($userChunks as $chunk) {
            $balanceTotalUsers += Account::whereIn('users_id', $chunk)->sum('balance');
        }

        $this->balance_total_users = $balanceTotalUsers;

        return $balanceTotalUsers;
    }
    private function balanceTotalAffiliates()
    {
        $users = User::whereNotNull('bonus3_nivelhierarquico')->pluck('id');
        $balanceTotalAffiliates = 0;
        $chunkSize = 1000; // Tamanho do lote

        $userChunks = $users->chunk($chunkSize);

        foreach ($userChunks as $userChunk) {
            $balanceTotalAffiliates += Account::whereIn('users_id', $userChunk)->sum('balance');
        }

        $this->balance_total_affiliates = $balanceTotalAffiliates;

        return $balanceTotalAffiliates;
    }
    public function render()
    {

        return view('livewire.admin.dashboard.home-indicadores');
    }
}
