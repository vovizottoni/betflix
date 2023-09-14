<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;


//Models Utilizadas
use App\Models\User;



class CheckInviteCodeRule implements Rule
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
        //se tem validation code, verifica se é de algum influenciador
        if($value){

            //
            $influenciador = User::where([['my_invite_code', '=', $value]])->first();
            if(empty($influenciador)){

                return false;

            }else{

                //encontrou o influenciador dono do my_invite_code
                return true;

            }



        //nao tem validation code, erro
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

            return 'Código de convite inválido.';

        }else if(Config::get('app.locale') == 'en'){

            return 'Invalid invite code.';

        }else{

            return 'Código de convite inválido.';

        }

    }
}
