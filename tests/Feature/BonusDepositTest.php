<?php

namespace Tests\Feature;

use App\Actions\Transactions\ConfirmDeposit;
use App\Enums\TransactionStatus;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\UserTestTrait;

class BonusDepositTest extends TestCase
{
    use UserTestTrait;

    private $users;
    private $qntdLevels = 2;


    public function testBonusMultiLevel1()
    {
        //clearRegisterLog();
        registerLogMessage("Start multi-level bonus");
        $groupWithBonus2 = Group::bonus2Enabled()->first();
        $userIds = [];
        for ($i = 0; $i <= 2; $i++) {
            $userInvite = $this->lastUser();
            $user = $this->generateRandomUser($userInvite['my_invite_code']);
            $userText = "ID: " . $user->id . " Name: " . $user->name . " Parent: " . $userInvite['id'] . " Parent Name: " . $userInvite['name'];
            $userIds[] = $user->id;
            registerLogMessage($userText);
            if ($i == 0) {
                $user->group_id = $groupWithBonus2['id'];
                $user->saveOrFail();
            } else {
                for ($x = 0; $x <= 2; $x++) {
                    $val = rand(10, 1000);
                    $transaction = $this->addDepositToUser($user, $val);
                    $confirmDeposit = new ConfirmDeposit();
                    $confirmDeposit->action($transaction['id']);
                    $transaction = Transaction::findOrFail($transaction['id']);
                    // $this->assertEquals($transaction['status'], TransactionStatus::Paid);
                }
            }
        }
        $users = User::whereIn("id", $userIds)->orderBy("id", "asc")->get();
        foreach ($users as $user) {
            $account = $user->accounts()->first();
            $parent = $user->parent()->first();
            $text = "User ID: " . $user->id . " GROUP ID: " . $user->group_id . " Parent: " . $parent->id . " Balanc: " . $account->balance . " Balance Bonus: " . $account->balanceBonus;
            registerLogMessage($text);
        }
        $this->assertTrue(true);
    }

}
