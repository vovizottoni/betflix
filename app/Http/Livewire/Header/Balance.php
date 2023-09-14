<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;


//Libs utilizadas
use Illuminate\Support\Facades\Auth;


//Models Utilizadas
use App\Models\Account;
use App\Models\Transaction;





class Balance extends Component
{

    public $currentBalanceSelected;



    public function mount(){


            //se usuario está logado e nao selecionou uma account, direciona p/ tela de 'selecionar account'
            if(Auth::check()){

                $account_id = getAccountIdSession();
                if(empty($account_id)){
                    return redirect()->route('player.accounts');
                }

            }



            $value = 0;

            $balanceUsed = session()->get('balanceUsed');
            $accountuid = getAccountIdSession();
            $account = Account::where('id', '=',  $accountuid)->first();

            if($balanceUsed == 'balance'){  //BRL

                $value = 'R$'.$account->balance;


            }else if($balanceUsed == 'balanceBonus'){ //BRL BONUS

                $value = 'R$'.$account->balanceBonus;


            }else if($balanceUsed == 'balanceUSD'){  //USD

                $value = '$'.$account->balanceUSD;


            }else if($balanceUsed == 'balanceUSDBonus'){  //USD BONUS

                $value = '$'.$account->balanceUSDBonus;

            }else { //BRL

                $value = 'R$'.$account->balance;


            }

            $this->currentBalanceSelected = $value;

    }

    public function render()
    {

        // -----------------------------------------------------------------------------------------------------------
        //Na view o evento: "wire:poll.6s"  da um re-render a cada 6seg, para poder atualizar o balance em tempo real

        $value = 0;

            $balanceUsed = session()->get('balanceUsed');
            $accountuid = getAccountIdSession();
            $account = Account::where('id', '=',  $accountuid)->first();

            if($balanceUsed == 'balance'){  //BRL

                $value = 'R$'.$account->balance;


            }else if($balanceUsed == 'balanceBonus'){ //BRL BONUS

                $value = 'R$'.$account->balanceBonus;


            }else if($balanceUsed == 'balanceUSD'){  //USD

                $value = '$'.$account->balanceUSD;


            }else if($balanceUsed == 'balanceUSDBonus'){  //USD BONUS

                $value = '$'.$account->balanceUSDBonus;

            }else { //BRL

                $value = 'R$'.$account->balance;


            }

            //se o usuario estiver no rollover e apenas uma transaction paid, aplica regra para setar o balanceUsed = balanceBonus

            if(Auth::user()->rollover_bonus1_opcao == 's' && is_numeric(Auth::user()->rollover_bonus1_multiplicador) && is_numeric(Auth::user()->rollover_bonus1_valorObjetivo)){

                //verifica se tem apenas uma transaction paid
                $numero_transactions_c_status_paid = 0;

                $accounts_user___ = Account::where([['users_id', '=', $account->users_id]])->get();

                foreach($accounts_user___ as $account_user___){
                    //busca transactions dessa account_user___
                    $transactions______ = Transaction::where([['accounts_id', '=', $account_user___->id]])->get();

                    foreach($transactions______ as $transaction______){

                        if(($transaction______->type == 'cashinPIX' || $transaction______->type == 'cashinCC' || $transaction______->type == 'coinGateCashin' ) && ($transaction______->status == 'paid' || $transaction______->status == 'coingate_paid') ){
                            ++$numero_transactions_c_status_paid;


                            if($numero_transactions_c_status_paid > 1){
                                break;
                            }
                        }
                    }
                    if($numero_transactions_c_status_paid > 1){
                        break;
                    }
                }

                if($numero_transactions_c_status_paid == 1){

                    //Define o balanceUsed como o BalanceBonus
                    session()->put('balanceUsed', 'balanceBonus');


                    //se trocou balance, recalcula value
                    $balanceUsed = session()->get('balanceUsed');

                    if($balanceUsed == 'balance'){  //BRL

                        $value = 'R$'.$account->balance;


                    }else if($balanceUsed == 'balanceBonus'){ //BRL BONUS

                        $value = 'R$'.$account->balanceBonus;


                    }else if($balanceUsed == 'balanceUSD'){  //USD

                        $value = '$'.$account->balanceUSD;


                    }else if($balanceUsed == 'balanceUSDBonus'){  //USD BONUS

                        $value = '$'.$account->balanceUSDBonus;

                    }else { //BRL

                        $value = 'R$'.$account->balance;


                    }


                }
            }


            $this->currentBalanceSelected = $value;

            // -----------------------------------------------------------------------------------------------------------
            // -----------------------------------------------------------------------------------------------------------




        return view('livewire.header.balance');
    }
}
