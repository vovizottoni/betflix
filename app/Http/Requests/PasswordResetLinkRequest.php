<?php

namespace App\Http\Requests;

use App\Rules\ValidateCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Fortify;

class PasswordResetLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'g-recaptcha-response' => ['required', new ValidateCaptchaRule()],
            Fortify::username() => 'required|email',
        ];
    }
}
