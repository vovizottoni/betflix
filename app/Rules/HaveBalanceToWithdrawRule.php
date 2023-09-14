<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

//Models Utilizadas
use App\Models\Account;
use App\Models\User;


class HaveBalanceToWithdrawRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $param__value;


    public function __construct($param__value)
    {

        $this->param__value = $param__value;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        //obtem account_id da ### sessao ###
        $value = getAccountIdSession();

        //verifica se account_id tem o saldo para ser sacado
        $account = Account::where([['id', '=', $value]])->first();

        if($account){

            //valor a ser sacado: $this->param__value
            //saldo: Account.balance

            $value___ = $this->convertMoneystrToMoneyfloat($this->param__value);

            bcscale(2);

            //verifica qual balance_used está sendo utilizado (sessao)  (OBS, bonus NAO pode ser sacado/withdraw)

            $comparacao = '';
            $balanceUsed____ = session()->get('balanceUsed');

            if($balanceUsed____ == 'balance'){ // APENAS BRL é permitido no saque PIX

                $comparacao = bccomp($account->balance, $value___);

            }else{

                if($balanceUsed____ == 'balanceBonus'){

                    //se está liberado o saque de bonus para esse user (user.rollover_bonus1_atingiu_valorObjetivo == 's')

                    $user = User::where([['id', '=', $account->users_id]])->first();

                    if($user->rollover_bonus1_atingiu_valorObjetivo == 's' &&  $user->rollover_bonus1_opcao == 's'){

                        $comparacao = bccomp($account->balance, $value___);

                    }else{

                        return false; //Nao pode sacar PIX de BONUS, nao atingiu objetivo
                    }


                }else{

                    return false; //Nao pode sacar,  Balance inválido

                }

            }




            if($comparacao === 0 || $comparacao === 1){

                //Pode Sacar pois  $account->balance >= $value___
                return true;

            }else {

                return false;

            }


        }else{

            return false;

        }




    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        if(Config::get('app.locale') == 'pt'){

            return 'Não há saldo suficiente nesta conta para saque';

        }else if(Config::get('app.locale') == 'en'){

            return 'There is not enough balance to withdraw';

        }else{

            return 'Não há saldo suficiente nesta conta para saque';

        }


    }






    private function convertMoneystrToMoneyfloat($value___){

        //trata $value___  (string) R$ 14.500,05 => (float) 14500.05
        $value___ = str_replace(['R', '$', ' ', '.'], '', $value___);
        $value___ = str_replace(',', '.', $value___);
        //$value___ = (float)$value___;

        return $value___;
    }





}
