<?php

namespace Tests\Traits;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Transactions\CreateNewCashin;
use App\Enums\TransactionType;
use App\Helpers\BrazilDocGen;
use App\Models\TokenAccount;
use App\Models\Transaction;
use App\Models\User;
use Database\Factories\UserFactory;

trait UserTestTrait
{
    private function generateRandomUser($inviteCode = null)
    {
        $defaultPwd = "Ax@Axc!222l_@#0Aac1";
        $createUser = new CreateNewUser();
        $factory = new UserFactory();
        $userData = $factory->definition();
        $postData = [
            'name' => $userData['name'],
            'gender' => 'm',
            'birth_date' => '17/12/1956',
            'my_invite_code' =>$userData['my_invite_code'],
            'email' => $userData['email'],
            'password' => $defaultPwd,
            'password_confirmation' => $defaultPwd,
            'cpf' => BrazilDocGen::cpfRandom(false),
            'terms' => 1
        ];
        if (!is_null($inviteCode)) {
            $postData['invite_code'] = $inviteCode;
        }
        return $createUser->create($postData);
    }

    private function addDepositToUser(User $user, $amount)
    {
        $createDeposit = new CreateNewCashin();
        $account = $user->accounts()->first();
        $name = $user->name;
        $document = $user->cpf;
        return $createDeposit->action($account, TransactionType::CashinPIX, $amount, $name, $document);
    }

    private function lastUser()
    {
        return User::where("id", ">", 0)->where("birth_date","1956-12-17")->orderBy("id", "desc")->first();
    }

    private function lastTokenAccount()
    {
        return TokenAccount::where("id", ">", 0)->orderBy("id", "desc")->first();
    }

    private function lastUnpaidDeposit()
    {
        return Transaction::incompleDeposits()->orderBy("id", "desc")->first();
    }


}
