<?php

namespace App\Actions\HypeTech;



use App\Models\Account;
use App\Models\Bonus;
use App\Models\CommandBonus3Processamento__;
use App\Models\User;

class ProcessBonus3Lose implements CreatesNewUsers
{

    public function process($checkBet)
    {

        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
        //PROCESSA BONUS3, caso este player (que tomou red) tenha sido indicado por um usuario-afiliado (user_id) que pertenca a alguma hierarquia de bonus3, PROCESSA bonus para esta Hierarquia


        //este usuário que perdeu a aposta, foi indicado por algum afiliado?
        $accountRed = Account::where([['id', '=',  $checkBet->accounts_id]])->first();

        //busca usuario que tomou red
        $userRed = User::where([['id', '=',  $accountRed->users_id]])->first();

        $userB = $userRed;

        //verifica se o USER que tomou red foi indicado por algum usuario-AFILIADO (user_id)
        if ($userB->user_id && $userB->invite_code && empty($userB->bonus3_nivelhierarquico) && $userB->fungamess_user_blocked == 0) {


            //consulta esse AFILIADO
            $afiliado = User::where([['id', '=', $userB->user_id]])->first();


            //se esse usuario-AFILIADO pertence a algum nivel hierarquico de bonus3 ( master , msupervisor, gerente, subgerente)
            if($afiliado->bonus3_nivelhierarquico == 'master' || $afiliado->bonus3_nivelhierarquico == 'supervisor' || $afiliado->bonus3_nivelhierarquico == 'gerente' || $afiliado->bonus3_nivelhierarquico == 'subgerente'){



                //###CÁLCULO DE BAIXO PARA CIMA###
                // 'master':  apenas master recebe: $afiliado->bonus3_percentual %  de  $checkBet->amount
                if($afiliado->bonus3_nivelhierarquico == 'master' && is_numeric($afiliado->bonus3_percentual)){


                    // ---------- MASTER  ----------

                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);



                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }


                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                    // grava esse bonus no BD (para histórico e calculo do commando semanal de pagamento)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- MASTER  ----------



                    //###CÁLCULO DE BAIXO PARA CIMA###
                    // 'master' e 'supervisor' recebem.  apenas master recebe: $afiliado->bonus3_percentual %  de  $checkBet->amount
                }else if($afiliado->bonus3_nivelhierarquico == 'supervisor' && is_numeric($afiliado->bonus3_percentual)){

                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    //cálculo de baixo p/ cima e distribuicao de percentuais
                    $supervisor = $afiliado;
                    $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();

                    // Define percentuais de master e supervisor
                    $percent_MASTER = (string)$master->bonus3_percentual;
                    $percent_SUPERVISOR = (string)$supervisor->bonus3_percentual;

                    //distribui percentuais
                    bcscale(2);
                    $percent_MASTER = bcsub($percent_MASTER, $percent_SUPERVISOR);
                    $percent_SUPERVISOR = $percent_SUPERVISOR; //de baixo pra cima
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@




                    // ---------- MASTER  ----------

                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $master;
                    $afiliado->bonus3_percentual = $percent_MASTER;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }


                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- MASTER  ----------





                    // ---------- supervisor  ----------


                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $supervisor;
                    $afiliado->bonus3_percentual = $percent_SUPERVISOR;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }



                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- supervisor  ----------



                }else if($afiliado->bonus3_nivelhierarquico == 'gerente' && is_numeric($afiliado->bonus3_percentual)){


                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    //cálculo de baixo p/ cima e distribuicao de percentuais
                    $gerente = $afiliado;
                    $supervisor = User::where([['id', '=', $gerente->bonus3_superiorhierarquico_user_id]])->first();
                    $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();

                    // Define percentuais de master e supervisor
                    $percent_MASTER = (string)$master->bonus3_percentual;
                    $percent_SUPERVISOR = (string)$supervisor->bonus3_percentual;
                    $percent_GERENTE = (string)$gerente->bonus3_percentual;

                    //distribui percentuais
                    bcscale(2);
                    $percent_MASTER = bcsub($percent_MASTER, $percent_SUPERVISOR);
                    $percent_SUPERVISOR = bcsub($percent_SUPERVISOR, $percent_GERENTE);
                    $percent_GERENTE = $percent_GERENTE; //de baixo pra cima
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@




                    // ---------- MASTER  ----------

                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $master;
                    $afiliado->bonus3_percentual = $percent_MASTER;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }


                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- MASTER  ----------






                    // ---------- supervisor  ----------


                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $supervisor;
                    $afiliado->bonus3_percentual = $percent_SUPERVISOR;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }


                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%


                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+'  ]);

                    // ---------- supervisor  ----------





                    // ---------- gerente  ----------


                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $gerente;
                    $afiliado->bonus3_percentual = $percent_GERENTE;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }


                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%

                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+'  ]);

                    // ---------- gerente  ----------



                }else if($afiliado->bonus3_nivelhierarquico == 'subgerente' && is_numeric($afiliado->bonus3_percentual)){


                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    //cálculo de baixo p/ cima e distribuicao de percentuais
                    $subgerente = $afiliado;
                    $gerente = User::where([['id', '=', $subgerente->bonus3_superiorhierarquico_user_id]])->first();
                    $supervisor = User::where([['id', '=', $gerente->bonus3_superiorhierarquico_user_id]])->first();
                    $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();

                    // Define percentuais de master e supervisor
                    $percent_MASTER = (string)$master->bonus3_percentual;
                    $percent_SUPERVISOR = (string)$supervisor->bonus3_percentual;
                    $percent_GERENTE = (string)$gerente->bonus3_percentual;
                    $percent_SUBGERENTE = (string)$subgerente->bonus3_percentual;

                    //distribui percentuais
                    bcscale(2);
                    $percent_MASTER = bcsub($percent_MASTER, $percent_SUPERVISOR);
                    $percent_SUPERVISOR = bcsub($percent_SUPERVISOR, $percent_GERENTE);
                    $percent_GERENTE = bcsub($percent_GERENTE, $percent_SUBGERENTE);
                    $percent_SUBGERENTE = $percent_SUBGERENTE; //de baixo pra cima
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@
                    // @@@@@@@@@@ Preparacao @@@@@@@@@@




                    // ---------- MASTER  ----------

                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $master;
                    $afiliado->bonus3_percentual = $percent_MASTER;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }



                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%


                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- MASTER  ----------






                    // ---------- supervisor  ----------


                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $supervisor;
                    $afiliado->bonus3_percentual = $percent_SUPERVISOR;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }



                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%


                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+'  ]);

                    // ---------- supervisor  ----------





                    // ---------- gerente  ----------


                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $gerente;
                    $afiliado->bonus3_percentual = $percent_GERENTE;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }



                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%

                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- gerente  ----------





                    // ---------- subgerente  ----------

                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                    $afiliado = $subgerente;
                    $afiliado->bonus3_percentual = $percent_SUBGERENTE;
                    //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                    ///////////////////////////////////////////////////////////////////////////////////////
                    //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                    $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                    $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                    $accountATUALIZADA = $primeira_account;
                    $balance_______ = 0;

                    $destinoB = 'balance';
                    $balance_______  = (string)$accountATUALIZADA->balance;
                    ///////////////////////////////////////////////////////////////////////////////////////


                    //calculo do bonus3 em BRL
                    $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                    bcscale(2);
                    $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                    $bonusFINAL = bcmul($percentB, $checkBet->amount);


                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                    //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                    //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)
                    // bcscale(2);
                    // $newBalanceBBB  = bcadd($balance_______, $bonusFINAL);
                    // Account::where([['id', '=',  $primeira_account->id]])->update([$destinoB => $newBalanceBBB]);
                    // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                    //obtem  bonus3_semanapagamento
                    $semanaPgto = '';
                    $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                    if(empty($bonus3_semanapagamentoOBJ)){

                        $semanaPgto = 1;

                    }else{

                        $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                    }



                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    if($checkBet->balance_used ==  'balance'){

                    }else if($checkBet->balance_used ==  'balanceBonus'){

                        $bonusFINAL = $bonusFINAL/2;

                    }
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                    // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%

                    // grava esse bonus no BD (para histórico)
                    Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $userB->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                    // ---------- subgerente  ----------






                }




            }


        }






        //vdr
        //processa bonus3 caso o user que tomou green faca parte da hierarquia (bonus3 sobe para os niveis acima dele)
        //processa bonus3 caso o user que tomou green faca parte da hierarquia (bonus3 sobe para os niveis acima dele)
        //vdr

        if(($userB->bonus3_nivelhierarquico == 'master' || $userB->bonus3_nivelhierarquico == 'supervisor' || $userB->bonus3_nivelhierarquico == 'gerente' || $userB->bonus3_nivelhierarquico == 'subgerente') && $userB->fungamess_user_blocked == 0){


            if($userB->bonus3_nivelhierarquico == 'master'){


                // -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@
                // -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@ -- @@
                //Master nao recebe nada por que nao tem NINGUEM ACIMA DELE NA HIERARQUIA
                //Master nao recebe nada por que nao tem NINGUEM ACIMA DELE NA HIERARQUIA


            }else if($userB->bonus3_nivelhierarquico == 'supervisor'){



                //cálculo de baixo p/ cima e distribuicao de percentuais

                $supervisor = $userB;
                $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();


                // Define percentuais de master e supervisor
                $percent_MASTER = (string)$master->bonus3_percentual;


                // //distribui percentuais
                bcscale(2);
                $percent_MASTER = $percent_MASTER;



                // ---------- MASTER  ----------

                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $master;
                $afiliado->bonus3_percentual = $percent_MASTER;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $supervisor->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                // ---------- MASTER  ----------






            }else if($userB->bonus3_nivelhierarquico == 'gerente'){


                //cálculo de baixo p/ cima e distribuicao de percentuais

                $gerente = $userB;
                $supervisor = User::where([['id', '=', $gerente->bonus3_superiorhierarquico_user_id]])->first();
                $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();


                // Define percentuais de master e supervisor
                $percent_MASTER = (string)$master->bonus3_percentual;
                $percent_SUPERVISOR = (string)$supervisor->bonus3_percentual;


                // //distribui percentuais
                bcscale(2);
                $percent_MASTER = bcsub($percent_MASTER, $percent_SUPERVISOR);
                $percent_SUPERVISOR = $percent_SUPERVISOR;



                // ---------- MASTER  ----------

                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $master;
                $afiliado->bonus3_percentual = $percent_MASTER;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%




                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $gerente->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                // ---------- MASTER  ----------






                // ---------- supervisor  ----------


                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $supervisor;
                $afiliado->bonus3_percentual = $percent_SUPERVISOR;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $gerente->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+'  ]);

                // ---------- supervisor  ----------




            }else if($userB->bonus3_nivelhierarquico == 'subgerente'){


                //cálculo de baixo p/ cima e distribuicao de percentuais
                $subgerente = $userB;
                $gerente = User::where([['id', '=', $subgerente->bonus3_superiorhierarquico_user_id]])->first();
                $supervisor = User::where([['id', '=', $gerente->bonus3_superiorhierarquico_user_id]])->first();
                $master = User::where([['id', '=', $supervisor->bonus3_superiorhierarquico_user_id]])->first();


                // Define percentuais de master e supervisor
                $percent_MASTER = (string)$master->bonus3_percentual;
                $percent_SUPERVISOR = (string)$supervisor->bonus3_percentual;
                $percent_GERENTE = (string)$gerente->bonus3_percentual;

                // //distribui percentuais
                bcscale(2);
                $percent_MASTER = bcsub($percent_MASTER, $percent_SUPERVISOR);
                $percent_SUPERVISOR = bcsub($percent_SUPERVISOR, $percent_GERENTE);
                $percent_GERENTE = $percent_GERENTE;



                // ---------- MASTER  ----------

                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $master;
                $afiliado->bonus3_percentual = $percent_MASTER;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##


                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $subgerente->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                // ---------- MASTER  ----------






                // ---------- supervisor  ----------


                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $supervisor;
                $afiliado->bonus3_percentual = $percent_SUPERVISOR;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $subgerente->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+'  ]);

                // ---------- supervisor  ----------





                // ---------- gerente  ----------


                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo
                $afiliado = $gerente;
                $afiliado->bonus3_percentual = $percent_GERENTE;
                //Coloca dados da preparacao nas variaveis do bloco de codigo abaixo


                ///////////////////////////////////////////////////////////////////////////////////////
                //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
                $id_primeira_account = Account::where([['users_id', '=', $afiliado->id]])->min('id');
                $primeira_account = Account::where([['id', '=', $id_primeira_account]])->first();

                $accountATUALIZADA = $primeira_account;
                $balance_______ = 0;

                $destinoB = 'balance';
                $balance_______  = (string)$accountATUALIZADA->balance;
                ///////////////////////////////////////////////////////////////////////////////////////


                //calculo do bonus3 em BRL
                $afiliado_bonus3_percentual_string = (string)$afiliado->bonus3_percentual;
                bcscale(2);
                $percentB = bcdiv($afiliado_bonus3_percentual_string, '100.0');
                $bonusFINAL = bcmul($percentB, $checkBet->amount);


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##
                //TRECHO ABAIXO COMENTADO POIS O PAGAMENTO DO BONUS3 é feito no comando de console semanal: CommandBonus3Processamento__
                //adiciona $bonusFINAL no balance da "Primeira account" do AFILIADO" (BD)

                // Nada, removido


                // ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ## ## ## ## ## ## ##  ## ## ##

                //obtem  bonus3_semanapagamento
                $semanaPgto = '';
                $bonus3_semanapagamentoOBJ = CommandBonus3Processamento__::orderBy('id', 'desc')->first();

                if(empty($bonus3_semanapagamentoOBJ)){

                    $semanaPgto = 1;

                }else{

                    $semanaPgto = $bonus3_semanapagamentoOBJ->bonus3_semanapagamento + 1;

                }


                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                if($checkBet->balance_used ==  'balance'){

                }else if($checkBet->balance_used ==  'balanceBonus'){

                    $bonusFINAL = $bonusFINAL/2;

                }
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%
                // 'balance': bonus3 100% , 'balanceBonus': bonus3 50%



                // grava esse bonus no BD (para histórico)
                Bonus::create(['accounts_id' => $primeira_account->id, 'group_id' => NULL, 'bets_id' => $checkBet->id, 'amount' => $bonusFINAL, 'group_tipo' => '3', 'users_id_gerador_do_bonus' => $subgerente->id, 'bonus3_processado' => 'n', 'bonus3_semanapagamento' => $semanaPgto, 'bonus3_sinal' =>  '+' ]);

                // ---------- gerente  ----------

            }

        }


        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
        //###############################----------------------------------------3333333
    }
}
