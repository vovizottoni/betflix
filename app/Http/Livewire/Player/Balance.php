<?php

namespace App\Http\Livewire\Player;

use Livewire\Component;


//models utilizadas
use App\Models\Account;
use App\Models\Bet;
use App\Models\FungamessGameGains;
use App\Models\TokenAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//libs
use Illuminate\Support\Facades\DB;

class Balance extends Component
{
    //account_id escolhida (sessao)
    public $accountuid;


    public $balanceUsed;

    public $balance; //BRL
    public $balanceBonus; //BRL
    public $balanceUSD; //USD
    public $balanceUSDBonus; //USD


    //progresso rolover
    public $current_value_rollover;
    public $total_value_rollover;
    public $rollover_active;
    public $rollover_complete;


    public function mount(){

        $this->accountuid = getAccountIdSession();
        $account = Account::where('id', '=',  $this->accountuid)->first();

        $this->balance = $account->balance;
        $this->balanceBonus = $account->balanceBonus;
        $this->balanceUSD = $account->balanceUSD;
        $this->balanceUSDBonus = $account->balanceUSDBonus;


        $this->balanceUsed = session()->get('balanceUsed');

        //pegando dados do rollover
        $accounts_user_logged = Account::where([['users_id', '=', $account->users_id]])->pluck('id')->toArray();

        $value_bets_user_greens = Bet::where([['result', '=', 'green'],['balance_used', '=', 'balanceBonus']])
            ->whereNotNull('games_id')
            ->whereIn('accounts_id', $accounts_user_logged)->get()->sum('amount');

        $value_bets_user_reds = Bet::where([['result', '=', 'red'],['balance_used', '=', 'balanceBonus']])
            ->whereNotNull('games_id')
            ->whereIn('accounts_id', $accounts_user_logged)->get()->sum('amount');

        $bets_nux = FungamessGameGains::where([['users_id', '=', Auth::user()->id], ['event_type','=', 'BetPlacing']])
            ->pluck('token')->toArray();

        $token_bets_used_balance = TokenAccount::whereIn('tokenu', $bets_nux)
            ->where([['balance_used', '=', 'balance'], ['is_fungamess', '=', 1]])
            ->pluck('tokenu')->toArray();

        $value_bets_nux = FungamessGameGains::whereIn('token', $token_bets_used_balance)->get()->sum('amount');

        $objective_rollover = $value_bets_user_greens + $value_bets_user_reds + $value_bets_nux;
        $user = User::where([['id', '=', $account->users_id]])->select('rollover_bonus1_opcao','rollover_bonus1_valorObjetivo', 'rollover_bonus1_atingiu_valorObjetivo')->first();

        //dados do rollover para o front
        $this->current_value_rollover = $objective_rollover;
        $this->total_value_rollover = (double) $user->rollover_bonus1_valorObjetivo;

        if($this->current_value_rollover > $this->total_value_rollover){
            $this->current_value_rollover = $this->total_value_rollover;
        }

        $this->rollover_active = $user->rollover_bonus1_opcao;

    }

    public function render()
    {
        return view('livewire.player.balance');
    }

    public function changeBalanceUsed($b){

        //altera a session de balanceUsed:
        session()->put('balanceUsed', $b);

        $this->balanceUsed = $b;


        //recarregar a página
        return redirect(request()->header('Referer'));


    }


}
