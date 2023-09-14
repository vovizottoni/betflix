<?php

namespace App\Helpers;

use App\Rules\ValidateCaptchaRule;
use Illuminate\Support\Facades\Http;

class Captcha
{

    public static function check($captcha)
    {
        if (env("APP_URL") == "http://btf-test.ssl.ws") {
            return true;
        }
        if (inLocalEnvironment() || inTestingEnvironment()) {
            return true;
        }
        try {
            $post_data = http_build_query(
                array(
                    'secret' => env('CAPTCHA_SECRET'),
                    'response' => $captcha,
                    'remoteip' => request()->getClientIp()
                )
            );
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );
            $context = stream_context_create($opts);
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
            $result = json_decode($response, true);
            if (isset($result['success']) && $result['success'] === true) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }

    }


    public static function inputName()
    {
        return "g-recaptcha-response";
    }

    public static function rules()
    {
        if (env("APP_URL") == "http://btf-test.ssl.ws") {
            return [];
        }

        if (inLocalEnvironment() || inTestingEnvironment()) {
            return [];
        } else {
            return ['required', new ValidateCaptchaRule()];

        }
    }


}