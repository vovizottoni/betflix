<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;


class CheckBirthDate implements Rule
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
        //
        $birth_date = $value;
        $birth_date_exploded = explode('/', $birth_date);


        $day = '';
        $month = '';
        $year = '';

        if (!isset($birth_date_exploded[1]) || !isset($birth_date_exploded[2])) {
            return false;
        }
        if (Config::get('app.locale') == 'pt' || Config::get('app.locale') == 'es') {

            if (!($birth_date_exploded[0] && $birth_date_exploded[1] && $birth_date_exploded[2])) {
                return false;
            }

            //dd/mm/yyyy  (29/02/1988)
            $day = $birth_date_exploded[0];
            $month = $birth_date_exploded[1];
            $year = $birth_date_exploded[2];


        } else if (Config::get('app.locale') == 'en') {

            if (!($birth_date_exploded[0] && $birth_date_exploded[1] && $birth_date_exploded[2])) {
                return false;
            }

            //mm/dd/yyyy  (02/29/1988)
            $day = $birth_date_exploded[1];
            $month = $birth_date_exploded[0];
            $year = $birth_date_exploded[2];


        } else {

            return false;

        }

        $mysql_date_format = $year . '-' . $month . '-' . $day;


        $day = (int)$day;
        $month = (int)$month;
        $year = (int)$year;


        //check is is valid date (pt/en/es)
        if (checkdate($month, $day, $year)) {


            //+18 anos ?
            $dob = $mysql_date_format;
            if (time() < strtotime('+18 years', strtotime($dob))) {
                return false;
            } else {

                return true;

            }

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
        if (Config::get('app.locale') == 'pt' || Config::get('app.locale') == 'es') {

            return 'Data de Nascimento Inválida (permitido apenas para +18).';

        } else if (Config::get('app.locale') == 'en') {

            return 'Invalid Date of Birth (only allowed for +18).';

        } else {

            return 'Data de Nascimento Inválida (permitido apenas para +18).';

        }


    }
}
