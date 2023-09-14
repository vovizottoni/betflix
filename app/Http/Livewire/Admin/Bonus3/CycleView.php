<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Models\Account;
use App\Models\Bet;
use App\Models\Bonus;
use App\Models\FungamessGameGains;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CycleView extends Component
{
    use WithPagination;

    public $affiliates;
    public $count_register_affiliates = 0;
    public $cashout_affiliates = 0;
    public $perPage = 50;
    public $currentPage = 1;
    public $search = '';

    public function mount()
    {

        $this->currentPage = 1;
    }

    public function loadAffiliates()
    {
        // Obtenha todos os afiliados
        $allAffiliates = $this->affiliaatesData();

        // Calcule o índice de início com base na página atual e no número de registros por página
        $startIndex = ($this->currentPage - 1) * $this->perPage;

        // Obtenha os afiliados para a página atual usando array_slice
        $this->affiliates = array_slice($allAffiliates, $startIndex, $this->perPage);
    }
    private function affiliaatesData()
    {
        $users_affiliates = User::whereNotNull('bonus3_nivelhierarquico')->select('name', 'my_invite_code', 'id','group_id')->get();


        $data_affiliates = [];

        foreach ($users_affiliates as $affiliate) {
            //Numero de registros do afiliado
            $count_register_affiliate = User::where('invite_code', $affiliate->my_invite_code)->count();

            $register_affiliate = User::where('invite_code', $affiliate->my_invite_code)->select('id')->pluck('id')->toArray();


            //PEGAR A ACCOUNT DO AFILIADO
            $accounts_affiliates = Account::where('users_id', $affiliate->id)->pluck('id')->toArray();
            //cashout
            $cashout_affiliates = Transaction::whereIn('type', ['cashoutPIX'])
                ->whereIn('accounts_id', $accounts_affiliates)
                ->where('status', '=', 'drawee')
                ->whereNotNull('created_at')
                ->count();
            //cashin
            $cashin_affiliates = Transaction::whereIn('type', ['cashinPIX'])
                ->whereIn('accounts_id', $accounts_affiliates)
                ->where('status', '=', 'paid')
                ->whereNotNull('created_at')
                ->count();
            //NET P&L
            $pay_amount = Bet::where('accounts_id', $accounts_affiliates)->where('result', 'green')
                ->selectRaw('SUM(amount * (odd - 1)) as pay_amount')
                ->value('pay_amount');
            $pay_amount_fungames_amount = FungamessGameGains::where('users_id', $register_affiliate)->where('event_type', 'BetPlacing')->select('amount')->sum('amount');
            $pay_amount_fungames_win = FungamessGameGains::where('users_id', $register_affiliate)->where('event_type', 'Win')->select('amount')->sum('amount');
            $pay_total = $pay_amount + $pay_amount_fungames_amount + $pay_amount_fungames_win;

            $totalBets_fg = FungamessGameGains::where('users_id', $register_affiliate)->select('amount')->sum('amount');
            $totalBets_ht = Bet::where('accounts_id', $accounts_affiliates)->select('amount')->sum('amount');
            $totalBets = $totalBets_fg + $totalBets_ht;

            $ggr = $totalBets - $pay_total;

            //REV
            $bonus_rev = Bonus::where('accounts_id', $accounts_affiliates)
                ->where('group_tipo', '=', '3')
                ->select('amount')
                ->sum('amount');

            //CPA
            $bonus_cpa = Bonus::where('accounts_id', $accounts_affiliates)
                ->where('group_tipo', '=', '2')
                ->select('amount')
                ->sum('amount');

            //PORCENTAGEM AFILIADO

            $cpa_details = Group::where('id', $affiliate->group_id)
            ->first();



            //QFTD
            $affiliate_cpa = User::where('invite_code', $affiliate->my_invite_code)->pluck('id')->toArray();
            $accounts_affiliates_cpa = Account::whereIn('users_id', $affiliate_cpa)->pluck('id')->toArray();
            $qftd_cpa = Transaction::whereIn('type', ['cashinPIX'])
                ->whereIn('accounts_id', $accounts_affiliates_cpa)
                ->where('status', '=', 'paid')
                ->where('is_first_deposit', '1')
                ->whereNotNull('created_at')
                ->count();

            $bonus_payable = Bonus::whereIn('accounts_id', $accounts_affiliates)
                ->where('pagou', 'n')
                ->select('amount')
                ->sum('amount');


            $data_affiliates[] = [
                'name' => $affiliate->name,
                'count_register_affiliate' => $count_register_affiliate,
                'cashout_affiliates' => $cashout_affiliates,
                'cashin_affiliates' => $cashin_affiliates,
                'ggr' => $ggr,
                'rev' => $bonus_rev,
                'cpa' => $bonus_cpa,
                'qftd' => $qftd_cpa,
                'bonus' => $bonus_payable,
                'cpa_details' => $cpa_details,

            ];
        }



        $this->affiliates = $data_affiliates;

        return $data_affiliates;
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }

        $this->loadAffiliates();
    }

    public function nextPage()
    {
        $this->currentPage++;
        $this->loadAffiliates();
    }


    public function render()
    {



        $this->loadAffiliates();
        return view('livewire.admin.bonus3.cycle-view', [
            'affiliates' => $this->affiliates,
        ]);
    }
}
