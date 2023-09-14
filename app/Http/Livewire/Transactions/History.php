<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;




//Libs utilizadas
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


//Models Utilizadas
use App\Models\Account;
use App\Models\Transaction;

//classes ultilitárias
use App\util\Util;




class History extends Component
{


    //TELA DE PESQUISA
    use WithPagination;

    //FILTROS

    public $amount_____= 25;

    public $accounts_user_selected;
    public $accounts_user;
    public $account_id;
    public $details_account_id;

    public $type;
    public $status;
    public $created_at__from;
    public $created_at__to;

    public $amount_from;
    public $amount_to;
    public $external_reference;



    //public $currency = '';
    public $cpfUser = '';


    //
    public $check_transaction;
    public $transactions_count;



    public function mount(){

        $this->type = "";

        $this->amount_from = 1; //valor inicial para o range
        $this->amount_to = 10000; //valor inicial para o range

        $this->account_id = getAccountIdSession();
        $this->accounts_user_selected = getAccountIdSession();
        $this->details_account_id = Account::where([['id' , '=',  $this->account_id]])->first();



        //checka se esse user nunca fez uma transaction
        $this->check_transaction =  Transaction::whereIn('accounts_id', function($query){
            $query->select('id')
            ->from(with(new Account)->getTable())
            ->where('users_id', Auth::user()->id);
        })->get();



        //MOEDA NAO ESTA ASSOCIADA AO IDIOMA MAS SIM A CONFIGURACAO QUE O USER ESCOLHER E FICARA NA SESSAO E HAVERA UM CAMPO NO BD PARA ESTE BALANCE



        //accounts do user
        $this->accounts_user = Account::where('users_id', '=', Auth::user()->id)->get();



        $this->cpfUser = Auth::user()->cpf; //Chave PIX Padrao




    }



    public function render(){


        $where = [];

        // type
        if ($this->type){

            $where[] = ['type', '=', $this->type];
        }

        // created_at from
        if($this->created_at__from){

            $this->created_at__from = str_replace("T", " ", $this->created_at__from);
            $this->created_at__from .= ":00";

            $where[] = ['created_at', '>=', $this->created_at__from];
        }

        // created_at to
        if($this->created_at__to){

            $this->created_at__to = str_replace("T", " ", $this->created_at__to);
            $this->created_at__to .= ":00";

            $where[] = ['created_at', '<=', $this->created_at__to];
        }


        // amount_from
        if($this->amount_from){

            $where[] = ['amount', '>=', $this->amount_from];

        }else{

            $this->amount_from = 0;

        }

        // amount_to
        if($this->amount_to){

            $where[] = ['amount', '<=', $this->amount_to];

        }else{

            $this->amount_to = 0;

        }


        if($this->external_reference){

            $where[] = ['transaction_code', '=', $this->external_reference];

        }

        //para a conta selecionada, se não tiver nenhuma pega tds do user;
        $selected_accounts[] = $this->accounts_user_selected;
        if($this->accounts_user_selected){
            $where[] = ['accounts_id', '=', $this->accounts_user_selected];

        }else{
            foreach($this->accounts_user as $account){
                $selected_accounts[] = $account->id;
            }
        }


        // status
        if ($this->status){

            if($this->status != 'coingate_canceled' && $this->status != 'coingate_waiting_for_payment'){

                //consulta ao BD padrão
                $where[] = ['status', '=', $this->status];
                $transactions = Transaction::where($where)->whereIn('accounts_id', $selected_accounts)->take($this->amount_____)->orderBy('id', 'desc')->get();

            }elseif($this->status == 'coingate_canceled'){

                //consulta ao BD caso seja filtrado as transações canceladas da coingate
                $transactions = Transaction::where($where)
                                            ->where(function ($query){
                                                        $query->where('status','=','coingate_invalid')
                                                            ->orWhere('status','=','coingate_expired')
                                                            ->orWhere('status','=','coingate_canceled')
                                                            ->orWhere('status','=','coingate_error');
                                                        })
                                            ->whereIn('accounts_id', $selected_accounts)
                                            ->take($this->amount_____)->orderBy('id', 'desc')->get();

            }elseif($this->status == 'coingate_waiting_for_payment'){

                //consulta ao BD caso seja filtrado as transações canceladas da coingate
                $transactions = Transaction::where($where)
                                            ->where(function ($query){
                                                        $query->where('status','=','coinGate_waiting_for_confimation')
                                                            ->orWhere('status','=','coingate_new')
                                                            ->orWhere('status','=','coingate_pending')
                                                            ->orWhere('status','=','coingate_confirming');
                                                        })
                                            ->whereIn('accounts_id', $selected_accounts)
                                            ->take($this->amount_____)->orderBy('id', 'desc')->get();

            }

        }else{
            //consulta ao BD caso o filtro de status não esteja sendo aplicado
            $transactions = Transaction::where($where)->whereIn('accounts_id', $selected_accounts)->take($this->amount_____)->orderBy('id', 'desc')->get();
        }

        //instanciando a classe para tratar o status
        $util = new Util();

        $this->transactions_count = $transactions->count();

        return view('livewire.transactions.history', [
            'transactions' => $transactions,
            'util' => $util,
        ] );
    }


    public function laodMore(){

        $this->amount_____ += 25;
    }


}
