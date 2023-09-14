<?php

namespace App\Rules;

use App\Helpers\ValidaCPFCNPJ;
use Illuminate\Contracts\Validation\Rule;

class ValidatePixKeyRule implements Rule
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
        $rule = new ValidaCPFCNPJ($value);
        if ($rule->valida()) {
            return true;
        } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } elseif (isUuid4($value)) {
            return true;
        } elseif (validaTelefone($value)) {
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
        return "Chave PIX Inválida.";
    }
}
