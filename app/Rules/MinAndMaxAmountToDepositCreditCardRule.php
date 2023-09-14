<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class MinAndMaxAmountToDepositCreditCardRule implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        //trata value_  (string) R$ 14.500,05 => (float) 14500.05
        $value_Aux = $value;
        $value_Aux = str_replace(['R', '$', ' ', '.'], '', $value_Aux);
        $value_Aux = str_replace(',', '.', $value_Aux);
        $value_Aux = (float)$value_Aux;



        //obtem deposito minimo e deposito maximo Para PIX
        $MIN_AMOUNT_DEPOSIT_CREDITCARD_BRL = (float) getMetaValue('min_amount_deposit_creditcard_brl');
        $MAX_AMOUNT_DEPOSIT_CREDITCARD_BRL = (float) getMetaValue('max_amount_deposit_creditcard_brl');

        if($value_Aux >= $MIN_AMOUNT_DEPOSIT_CREDITCARD_BRL && $value_Aux <= $MAX_AMOUNT_DEPOSIT_CREDITCARD_BRL){

            return true;

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

            return 'O valor deve ser maior que R$'.getMetaValue('min_amount_deposit_creditcard_brl').' e menor que R$'.getMetaValue('max_amount_deposit_creditcard_brl').'.';

        }else if(Config::get('app.locale') == 'en'){

            return 'The value must be greater than $'.getMetaValue('min_amount_deposit_creditcard_brl').' and less than $'.getMetaValue('max_amount_deposit_creditcard_brl').'.';

        }else{

            return 'O valor deve ser maior que R$'.getMetaValue('min_amount_deposit_creditcard_brl').' e menor que R$'.getMetaValue('max_amount_deposit_creditcard_brl').'.';

        }



    }
}
