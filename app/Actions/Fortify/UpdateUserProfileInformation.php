<?php

namespace App\Actions\Fortify;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;


class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        //     'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        //     'cpf' => ['required', 'string', 'max:14'],
        //     'birth_date' => ['required', 'date']
        // ])->validateWithBag('updateProfileInformation');

        // if (isset($input['photo'])) {
        //     $user->updateProfilePhoto($input['photo']);
        // }

        // if ($input['email'] !== $user->email &&
        //     $user instanceof MustVerifyEmail) {
        //     $this->updateVerifiedUser($user, $input);
        // } else {
        //     $user->forceFill([
        //         'name' => $input['name'],
        //         'email' => $input['email'],
        //         'cpf' => preg_replace('/\D/', '', $input['cpf']), //remove qualquer caracter que não seja número
        //         'birth_date' => $input['birth_date'],
        //     ])->save();
        // }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'cpf' => $input['cpf'],
            'birth_date' => $input['birth_date'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
