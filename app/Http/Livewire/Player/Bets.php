<?php

namespace App\Http\Livewire\Player;


use Livewire\Component;

//models utilizadas
use App\Models\Account;
use App\Models\Bet;
use App\Models\Game;
use App\Models\FungamessGameGains;
use Carbon\Carbon;
//Libs utilizadas
use Livewire\WithPagination;



class Bets extends Component
{
    //TELA DE PESQUISA
    use WithPagination;

    //ESTATISTICAS DA AMOUNT
    public $amount_user;
    public $total;
    public $total_amount_balance;
    public $total_bets;
    public $count_bets;


    //FILTROS

    public $account_id;
    public $details_account_id;

    public $game;
    public $games;
    public $result;
    public $created_at__from;
    public $created_at__to;
    public $searchCode;

    public $balance_used;


    //receber nome dos games

    public $game_to;
    public $dt;



    public $amount = 25;


    public function mount(){



        $this->account_id = getAccountIdSession();
        $this->details_account_id = Account::where([['id' , '=',  $this->account_id]])->first();






        //-------------------------------------------------------
        //SOMATORIO DOS GREENS
        $bets_positve_balance = Bet::where([['accounts_id' , '=',  $this->account_id]])->where('result','green')->where('balance_used', 'balance')->get();

        $this->total_amount_balance = 0.0;

        bcscale(2);

        foreach ($bets_positve_balance as $positive_item) {


           $this->total_amount_balance += (float) bcsub(bcmul($positive_item->amount,$positive_item->odd),$positive_item->amount);


        }


        //-------------------------------------------------------
        //SOMATORIO DOS APOSTAS FEITOS NA CONTA
        $this->total_bets = Bet::where([['accounts_id' , '=',  $this->account_id]])->count();



        //SOMATORIO DOS GREENS FUNGAMESS
        $fungamess_game_gains = FungamessGameGains::where([
            ['users_id', '=', $this->details_account_id->users_id]
        ])->where('direction', 'credit')
        ->where('event_type', 'Win')
        ->sum('amount');

        $total_fungamess_game_gains = FungamessGameGains::where([
            ['users_id', '=', $this->details_account_id->users_id]
        ])->count();

        $this->total_amount_balance += $fungamess_game_gains;
        $this->total_bets += $total_fungamess_game_gains;

        // print_r($fungamess_game_gains); exit;
    }




    public function render(){



        $where = [];

        // game
        if ($this->game){

            $where[] = ['games_id', '=', $this->game];
        }

        // results
        if ($this->result){

            $where[] = ['result', '=', $this->result];
        }

        // created_at from
        if($this->created_at__from){


            $where[] = ['created_at', '>=', $this->created_at__from];
        }

        // created_at to
        if($this->created_at__to){


            $where[] = ['created_at', '<=', $this->created_at__to];
        }


        if($this->balance_used){

            $where[] = ['balance_used', '=', $this->balance_used];

        }
        if($this->searchCode){
            $where[] = ['bet_code', '=', $this->searchCode];
        }


        //consulta ao BD
        $bets = Bet::where($where)->where('accounts_id', '=', $this->account_id )->take($this->amount)->orderBy('created_at', 'desc')->get();


        // RECEBER TODOS GAMES
        $this->games = Game::orderBy('name', 'asc')->get();


        // RECEBER DATA DO DIA PARA CONDIÇÃO BADGE DE UPDATE AT

        //$now = now();
        $this->dt = Carbon::today();
        //dd($this->dt);

        // Junta o historico de jogos FUNGAMESS
        $query_fungamess_game_gains = FungamessGameGains::where([
            ['users_id', '=', $this->details_account_id->users_id]
        ])->orderBy('created_at', 'desc')->get();

        foreach($query_fungamess_game_gains as $item){

            $result = 'green';
            if($item->direction == 'debit'){
                $result = 'red';
            }

            $obj =  (object) [
                'result' => $result,
                'amount' => $item->amount,
                'odd' => 1,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'bet_code' => $item->event_id,
                'balance_used' => 'balance',
                'game_fungamess_id' => $item->game_id,
            ];
            $bets[] = $obj;
        }

        $this->count_bets = $bets->count();

        return view('livewire.player.bets', [
            'bets' => $bets
        ]);
    }

    //BOTÃO LOADMORE
    public function laodMore()
    {
        $this->amount += 25;
    }
}
