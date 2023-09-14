<?php

namespace App\Actions\Fortify;

use App\Helpers\Captcha;
use App\Models\User;
use App\Models\Account;
use App\Models\Group;
use App\Rules\SslConfig\ValidateCaptchaRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

//Rules Utilizadas
use App\Rules\ValidateCPF;
use App\Rules\CheckInviteCodeRule;

//Rule para validar invite_code (utilizou invite code de alguem p/ ganhar bonus)
use App\Rules\ValidateCountry;

//Rule para validar se país foi escolhido
use App\Rules\CheckBirthDate;

//Rule para validar se data de nascimento é valida e usuario tem +18 anos
use Illuminate\Validation\Rule;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    private static function validateCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF possui 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }
        $digit1 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        // Calcula o segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }
        $digit2 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        // Verifica se os dígitos verificadores são válidos
        if ($cpf[9] != $digit1 || $cpf[10] != $digit2) {
            return false;
        }

        return true;
    }

    private static function validateCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se o CNPJ possui 14 dígitos
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $sum = 0;
        for ($i = 0, $j = 5; $i < 12; $i++) {
            $sum += intval($cnpj[$i]) * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $digit1 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        // Calcula o segundo dígito verificador
        $sum = 0;
        for ($i = 0, $j = 6; $i < 13; $i++) {
            $sum += intval($cnpj[$i]) * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $digit2 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        // Verifica se os dígitos verificadores são válidos
        if ($cnpj[12] != $digit1 || $cnpj[13] != $digit2) {
            return false;
        }

        return true;
    }

    private function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }


    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        $messages = ['my_invite_code.unique' => 'O apelido que você está tentando utilizar já existe',];
        if (!isset($input['invite_code'])) {
            $input['invite_code'] = null;
        }
        $input['password_confirmation'] = $input['password'];
        $input['cpf'] = $this->clean($input['cpf']);
        Validator::make($input, [
            Captcha::inputName() => Captcha::rules(),
            'name' => ['required', 'string', 'max:255'],
            //'gender' => ['required', 'string', 'min:1', 'max:1'],

            'birth_date' => ['required', 'string', 'min:10', 'max:10', new CheckBirthDate()], // ###CUSTOM RULE###

            'my_invite_code' => ['required', 'string', 'min:6', 'max:20', 'unique:users,my_invite_code'],  //my_invite_code == nickname (único)
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            //'cpf' => ['required', 'string', 'min:9', 'max:11', 'regex:/^[0-9]{10,12}$/', 'unique:users,cpf'],
            'cpf' => [
                'required',
                'string',
                'regex:/^(?:\d{3}\.?\d{3}\.?\d{3}\-?\d{2}|\d{2}\.?\d{3}\.?\d{3}\/?\d{4}\-?\d{2})$/',
                'unique:users,cpf',
                function ($attribute, $value, $fail) {
                    $cleanValue = preg_replace('/[^0-9]/', '', $value);

                    if (strlen($cleanValue) == 11) {
                        // CPF validation
                        if (!self::validateCPF($cleanValue)) {
                            $fail('CPF inválido.');
                        }
                    } elseif (strlen($cleanValue) == 14) {
                        // CNPJ validation
                        if (!self::validateCNPJ($cleanValue)) {
                            $fail('CNPJ inválido.');
                        }
                    } else {
                        $fail('O campo deve ser um CPF ou CNPJ válido.');
                    }
                },
            ],
            /* 'country' => ['required', new ValidateCountry()], */
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'invite_code' => $input['invite_code'] != null ? ['sometimes', 'string', 'min:6', 'max:20', new CheckInviteCodeRule()] : [], //'sometimes': apenas se estiver preenchido, aplica os demais validates de  invite_code

        ], $messages)->validate();
        /*         $this->validate([
                    'my_invite_code' => 'required|string|min:6|max:20|unique:users,my_invite_code'

                ]); */


        //se eu utilizei um 'invite_code', insere no BD: user_id e invite_code relacionados
        $user_id = NULL;
        $influenciador = NULL;
        $invite_code = NULL;
        if ($input['invite_code']) {
            $influenciador = User::where([['my_invite_code', '=', $input['invite_code']]])->first();

            if ($influenciador) {
                $user_id = $influenciador->id;
                $invite_code = $input['invite_code'];
            }
        }


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //  my_invite_code nao pode ser alterado nunca. Um user poderá ter seu group_id trocado no admin, eventualmente
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //group_id define quai beneficios serao aplicados ao usuario e/ou influenciador. Todo usuario inicialmente pertence ao grupo padrao: group.tipo == 'padrao'

        //obtem esse grupo (que é gerado por seeder)
        $groupPadrao = Group::where([['tipo', '=', 'padrao']])->first();


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //formata data de nascimento
        $birth_date = implode('-', array_reverse(explode('/', $input['birth_date'])));


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


        $userCriado = User::create([
            'name' => $input['name'],
            'my_invite_code' => $input['my_invite_code'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cpf' => $input['cpf'],
            'country' => /* $input['country'] */ 'BR',
            'user_id' => $user_id,
            'invite_code' => $invite_code,
            'group_id' => 20,
            //'gender' => $input['gender'],
            'birth_date' => $birth_date
        ]);


        //* ** ** ** ** */
        //Cria uma account inicial para este user $userCriado

        //Gera um nome aleatorio para a conta que será criada para este $userCriado
        /*
        $length = 5;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        */


        $accountName = $input['name'];

        $accountInicial = Account::create(['name' => $accountName, 'users_id' => $userCriado->id, 'balance' => 0.0, 'balanceBonus' => 0.0, 'balanceUSD' => 0.0, 'balanceUSDBonus' => 0.0, 'photo' => 'assets/images/avatars/avatar-1.jpeg']);


        //Adiciona esta $accountInicial->id como a account escolhida
        session()->put('account_id', $accountInicial->id);

        //Define o balanceUsed como o valor 'balance'   (Balance em Reais)
        session()->put('balanceUsed', 'balance');


        return $userCriado;
    }
}
