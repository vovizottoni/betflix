<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

//Emails enviados
use App\Mail\CashinCCPaid;




//Models Utilizadas
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Group;
use App\Models\Bonus;



class checkccpaymentpagstar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkccpaymentpagstar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //************************* ###### *********************** */
        //Registrar no Kernel
        //Roda de 5 em 5 minutos
        //************************* ###### *********************** */


        $transactions = Transaction::where([['type', '=', 'cashinCC'], ['status', '=', 'waiting_for_payment']])->get();

        foreach($transactions as $transaction){

            if($transaction->external_reference){

                //faz requisicao a API pagstar (Check Status)
                try{

                    $response = Http::get('https://api.pagstar.com/api/v2/wallet/partner/transactions/'.$transaction->external_reference.'/check', [
                    ]);

                    if($response->ok()){  // http code === 200

                        //Pagamento confirmado pela API Pagstar (atualiza no BD)
                        Transaction::where([['id', '=', $transaction->id]])->update(['status' => 'paid']);






                        //Adiciona Saldo para a conta associada a $transaction

                        $account = Account::where([['id', '=', $transaction->accounts_id]])->first();

                        //adiciona saldo somando no PHP

                        bcscale(2);


                        $balance = 0;

                        //verifica qual o balance_used da $transaction->id
                        if($transaction->balance_used == 'balance'){  //BRL

                            $balance = (string)$account->balance;

                        }else if($transaction->balance_used == 'balanceBonus'){ //BRL

                            $balance = (string)$account->balanceBonus;

                        }else{ // NAO eh BRL

                            continue;

                        }



                        $amount  = (string)$transaction->amount;

                        $newBalance  = bcadd($balance, $amount);

                        //precisa tratar $newBalance ???

                        //Update
                        Account::where([['id', '=', $transaction->accounts_id]])->update([$transaction->balance_used  => $newBalance]);












                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111
                        //Adiciona BONUS1, caso exista


                        $bonus1_cancelado = false; //variavel relacionada ao piso do bonus1


                        //é Primeiro depósito? numero_transactions_c_status_paid == 1 e essa transaciton == $transaction->id
                        //é Primeiro depósito? numero_transactions_c_status_paid == 1 e essa transaciton == $transaction->id
                        $e_primeiro_deposito = false;
                        $numero_transactions_c_status_paid = 0;
                        $id_da_transaction_c_status_paid = 0;

                        $accounts_user___ = Account::where([['users_id', '=', $account->users_id]])->get();

                        foreach($accounts_user___ as $account_user___){

                            //busca transactions dessa account_user___
                            $transactions______ = Transaction::where([['accounts_id', '=', $account_user___->id]])->get();

                            foreach($transactions______ as $transaction______){

                                if(($transaction______->type == 'cashinPIX' || $transaction______->type == 'cashinCC') && $transaction______->status == 'paid'){

                                    ++$numero_transactions_c_status_paid;
                                    $id_da_transaction_c_status_paid = $transaction______->id;

                                    if($numero_transactions_c_status_paid > 1){
                                        break;
                                    }

                                }

                            }
                            if($numero_transactions_c_status_paid > 1){
                                break;
                            }
                        }
                        if($numero_transactions_c_status_paid == 1 && $id_da_transaction_c_status_paid == $transaction->id){
                            $e_primeiro_deposito = true;
                        }





                        if($e_primeiro_deposito){

                            //Consulta Account novamente por que o balance foi alterado ^^^ ^^^ ^^^
                            $accountATUALIZADA = Account::where([['id', '=', $transaction->accounts_id]])->first();
                            $balance_______ = 0;


                            //detecta grupo do user
                            $userB = User::where([['id', '=', $account->users_id]])->first();
                            if($userB->group_id){
                                $group = Group::where([['id', '=', $userB->group_id]])->first();

                                if($group->bonus1_status == 'active'){

                                    //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)
                                    //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)

                                    if($transaction->amount < $group->bonus1_piso_integer){

                                        //cancela este bonus1
                                        $bonus1_cancelado = true;

                                    }


                                    if($bonus1_cancelado == false){


                                        //1)checka teto
                                        //1)checka teto
                                        $valueB = $transaction->amount;
                                        if($transaction->amount > $group->bonus1_teto_integer){

                                            $valueB = $group->bonus1_teto_integer;

                                        }
                                        $valueB = (string)$valueB;



                                        //2) calcula bonus: $group->bonus1_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus1_percentual_valor_integer)/100.0;
                                        //2) calcula bonus: $group->bonus1_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus1_percentual_valor_integer)/100.0;
                                        bcscale(2);
                                        $percentB = bcdiv($group->bonus1_percentual_valor_integer, '100.0');
                                        $bonusFINAL = bcmul($percentB, $valueB);



                                        //3) verifica Moeda e qual balance receberá o bonus
                                        //3) verifica Moeda e qual balance receberá o bonus
                                        $destinoB = "";

                                        //verifica qual MOEDA do balance_used da $transaction->id
                                        if($transaction->balance_used == 'balance' || $transaction->balance_used == 'balanceBonus'){  //BRL--


                                            //verifica se bonus vai p/  balanceNormal ou BalanceBonus
                                            if($group->bonus1_destino == 'balanceNormal'){

                                                $destinoB = 'balance';

                                                $balance_______  = (string)$accountATUALIZADA->balance;

                                            }else{

                                                $destinoB = 'balanceBonus';

                                                $balance_______  = (string)$accountATUALIZADA->balanceBonus;

                                            }


                                        }else if($transaction->balance_used == 'balanceUSD' || $transaction->balance_used == 'balanceUSDBonus'){ //USD--

                                            //verifica se bonus vai p/  balanceNormal ou BalanceBonus
                                            if($group->bonus1_destino == 'balanceNormal'){

                                                $destinoB = 'balanceUSD';

                                                $balance_______  = (string)$accountATUALIZADA->balanceUSD;


                                            }else{

                                                $destinoB = 'balanceUSDBonus';

                                                $balance_______  = (string)$accountATUALIZADA->balanceUSDBonus;

                                            }


                                        }else{

                                            // Outra moeda tratar
                                            // Outra moeda tratar

                                            continue;

                                        }


                                        //4) adiciona bonus no balance (BD)
                                        //4) adiciona bonus no balance (BD)
                                        bcscale(2);
                                        $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);

                                        //Update
                                        Account::where([['id', '=', $transaction->accounts_id]])->update([  $destinoB => $newBalanceBBB ]);


                                        //5) grava esse bonus no BD (para histórico)
                                        //5) grava esse bonus no BD (para histórico)
                                        Bonus::create(['accounts_id' => $transaction->accounts_id, 'group_id' => $userB->group_id, 'transactions_id' => $transaction->id, 'amount' => $bonusFINAL, 'group_tipo' => '1', 'users_id_gerador_do_bonus' => $account->users_id ]);

                                    }


                                }

                            }

                        }

                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111
                        //###############################----------------------------------------1111111














                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222
                        //Adiciona BONUS2, caso exista


                        $bonus2_cancelado = false; //variavel relacionada ao piso do bonus2


                        // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
                        //2) Bônus 02: [Afiliado] Bônus sobre primeiro depósito:
                        //O afiliado irá ganhar x% do valor do primeiro depósito dos indicados dele;

                        if($e_primeiro_deposito){

                            //obtem o USER da transaction marcada como PAID
                            $userB = User::where([['id', '=', $account->users_id]])->first();



                            //verifica se o USER dessa transaction foi indicado por algum AFILIADO (user_id)
                            if($userB->user_id && $userB->invite_code){

                                //consulta esse AFILIADO
                                $afiliado = User::where([['id', '=', $userB->user_id]])->first();

                                //se esse afiliado pertence algum grupo de Bonus
                                if($afiliado->group_id){

                                    //consulta esse Grupo
                                    $group = Group::where([['id', '=', $afiliado->group_id]])->first();

                                    //se esse grupo tem bonus2
                                    if($group->bonus2_status == 'active'){



                                        ///////////////////////////////////////////////////////////////////////////////////////
                                        //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                                        $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                                        $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                                        $accountATUALIZADA = $primeira_account;
                                        $balance_______ = 0;
                                        ///////////////////////////////////////////////////////////////////////////////////////



                                        //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus2)
                                        //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus2)

                                        if($transaction->amount < $group->bonus2_piso_integer){

                                            //cancela este bonus2
                                            $bonus2_cancelado = true;

                                        }


                                        if($bonus2_cancelado == false){


                                            //1)checka teto
                                            //1)checka teto
                                            $valueB = $transaction->amount;
                                            if($transaction->amount > $group->bonus2_teto_integer){

                                                $valueB = $group->bonus2_teto_integer;

                                            }
                                            $valueB = (string)$valueB;





                                            //2) calcula bonus: $group->bonus2_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus2_percentual_valor_integer)/100.0;
                                            //2) calcula bonus: $group->bonus2_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus2_percentual_valor_integer)/100.0;
                                            bcscale(2);
                                            $percentB = bcdiv($group->bonus2_percentual_valor_integer, '100.0');
                                            $bonusFINAL = bcmul($percentB, $valueB);



                                            //3) verifica Moeda e qual balance receberá o bonus
                                            //3) verifica Moeda e qual balance receberá o bonus
                                            $destinoB = "";

                                            //verifica qual MOEDA do balance_used da $transaction->id
                                            if($transaction->balance_used == 'balance' || $transaction->balance_used == 'balanceBonus'){  //BRL--


                                                //verifica se bonus vai p/  balanceNormal ou BalanceBonus
                                                if($group->bonus2_destino == 'balanceNormal'){

                                                    $destinoB = 'balance';

                                                    $balance_______  = (string)$accountATUALIZADA->balance;

                                                }else{

                                                    $destinoB = 'balanceBonus';

                                                    $balance_______  = (string)$accountATUALIZADA->balanceBonus;

                                                }


                                            }else if($transaction->balance_used == 'balanceUSD' || $transaction->balance_used == 'balanceUSDBonus'){ //USD--

                                                //verifica se bonus vai p/  balanceNormal ou BalanceBonus
                                                if($group->bonus2_destino == 'balanceNormal'){

                                                    $destinoB = 'balanceUSD';

                                                    $balance_______  = (string)$accountATUALIZADA->balanceUSD;


                                                }else{

                                                    $destinoB = 'balanceUSDBonus';

                                                    $balance_______  = (string)$accountATUALIZADA->balanceUSDBonus;

                                                }


                                            }else{

                                                // Outra moeda tratar
                                                // Outra moeda tratar

                                                continue;

                                            }


                                            //4) adiciona bonus no balance (BD)
                                            //4) adiciona bonus no balance (BD)
                                            bcscale(2);
                                            $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);

                                            //Update, ADD BONUS PARA AFILIADO
                                            Account::where([['id', '=',  $primeira_account->id ]])->update([  $destinoB => $newBalanceBBB ]);



                                            //5) grava esse bonus no BD (para histórico)
                                            //5) grava esse bonus no BD (para histórico)
                                            Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => $afiliado->group_id, 'transactions_id' => $transaction->id, 'amount' => $bonusFINAL, 'group_tipo' => '2', 'pagou' => 's', 'users_id_gerador_do_bonus' => $account->users_id ]);

                                        }



                                    }


                                }


                            }

                        }

                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222
                        //###############################----------------------------------------2222222












                        //¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬
                        //¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬
                        //Envio-de-email

                        $account_details = Account::where([['id' , '=',  $transaction->accounts_id]])->first();

                        //busca name do user
                        $user_corrente = User::where([['id' , '=',  $account_details->users_id]])->first();





                        $parametros__ = [ 'name' => $user_corrente->name, 'account_id_name' => $account_details->name, 'value_' => $transaction->amount, 'transaction_code' => $transaction->transaction_code ];


                        // Mail::to($user_corrente->email)->send(new CashinCCPaid(env('MAIL_FROM_ADDRESS_NO_REPLY'), __('mail.subject_cashIn_cc_paid'), $parametros__));


                        //¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬
                        //¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬




                    }else{

                        //Pagamento nao confirmado ou nao existente ou falha

                        continue;

                    }


                }catch(\Exception $e){  //falha na requisicao, continue para proxima iteracao

                        continue;
                }




            }

        }




        return Command::SUCCESS;
    }
}
