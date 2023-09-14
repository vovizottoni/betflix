<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class MinAndMaxAmountToWithdrawPixRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //trata value_  (string) R$ 14.500,05 => (float) 14500.05
        $value_Aux = $value;
        $value_Aux = str_replace(['R', '$', ' ', '.'], '', $value_Aux);
        $value_Aux = str_replace(',', '.', $value_Aux);
        $value_Aux = (float)$value_Aux;


        //obtem saque minimo e saque maximo Para modo PIX
        $MIN_AMOUNT_WITHDRAW_PIX_BRL = (float) env('MIN_AMOUNT_WITHDRAW_PIX_BRL');
        
        // $MAX_AMOUNT_WITHDRAW_PIX_BRL = (float) env('MAX_AMOUNT_WITHDRAW_PIX_BRL');

        if ($value_Aux >= $MIN_AMOUNT_WITHDRAW_PIX_BRL) {

            return true;

        } else {

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
        return __("cashout.msg_limit_cashout", ['min' => env('MIN_AMOUNT_WITHDRAW_PIX_BRL'), 'max' => env('MAX_AMOUNT_WITHDRAW_PIX_BRL')]);


    }
}
