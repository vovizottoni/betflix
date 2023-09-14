<?php

namespace App\Http\Livewire\Referral;

use App\Http\Livewire\Player\Accounts;
use App\Models\Account;
use App\Models\Bonus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithPagination;

class BonusPlayer extends Component
{
    //TELA DE PESQUISA
    use WithPagination;

    //ESTATISTICAS DA AMOUNT
    public $amount_user;
    public $total;
    public $total_amount_balance;
    public $total_bets;


    //FILTROS

    public $account_id;
    public $details_account_id;
    public $where;
    public $game;
    public $games;
    public $result;
    public $created_at__from;
    public $created_at__to;

    public $amount_from;
    public $amount_to;
    public $balance_used;
    public $external_reference;

    //receber nome dos games

    public $amount = 25;
    public $accounts_user;
    public $accounts_user_selected = '';
    public $group_tipo;
    public $user_gerador;


    public function mount()
    {

        $this->account_id =  getAccountIdSession();
    }


    public function render()
    {

        $columns = new BonusPlayerDataTable();
        $columns = $columns->DataTableColumn();


        //BUSCA DAS ACCOUNTS
        $this->accounts_user = Account::where('users_id', '=', Auth::user()->id)->get();


        // return view('livewire.referral.bonus-player',[
        //     'bonus' => $bonus

        return view('livewire.referral.bonus-player', [
            'columns' => $columns,

        ]);
    }


    public function laodMore()
    {
        $this->amount += 25;
    }
}
