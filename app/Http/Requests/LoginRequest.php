<?php

namespace App\Http\Requests;

use App\Helpers\Captcha;
use App\Rules\ValidateCaptchaRule;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Laravel\Fortify\Fortify;

class LoginRequest extends FortifyLoginRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            Captcha::inputName() => Captcha::rules(),
            Fortify::username() => 'required|email',
            'password' => 'required|string'
        ];
    }
}
