<?php

namespace Tests;

use App\Actions\Games\GetGamePlayLink;
use App\Actions\Transactions\ConfirmDeposit;
use App\Enums\FungamesEventType;
use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\FungamessGameGains;
use App\Models\FungamessGames;
use App\Models\Transaction;
use Tests\Traits\UserTestTrait;

trait HelpTestTrait
{
    use UserTestTrait;

    public function funGamesByPopularity()
    {
        return ['aviator-1020440', 'live-spaceman-1007025', 'magnify-man-1009101', 'courier-sweeper-1005103', 'jetx-1002816', 'penalty-shoot-out-1005121'];
    }

    public function prime100Numbers()
    {
        return [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97];
    }

    public function getRandomPrimeNumber()
    {
        $list = $this->prime100Numbers();
        return $this->getRandomValue($list);
    }

    public function sortMoneyNumber($min = 1, $max = 500)
    {
        $n = rand($min, $max);

        return safeSum($n, safeDiv($this->getRandomPrimeNumber(), 100));
    }


    public function getRandomValue($array)
    {
        $limit = count($array);
        $index = rand(1, $limit);
        return $array[$index - 1];
    }

    function getIframeLink()
    {

        $user = $this->generateRandomUser();
        $gamesCodes = $this->funGamesByPopularity();

        $sortedGameCode = $this->getRandomValue($gamesCodes);
        $account = $user->accounts()->first();
        $action = new GetGamePlayLink();
        $action = $action->get($this->provider, $sortedGameCode, $this->balanceUsed, $account);

        return isset($action['url']);

    }

    function getLastBetWinFungames()
    {
        return FungamessGameGains::where("event_type", FungamesEventType::Win)->orderBy("id", "desc")->first();
    }

    function getLastCashout($accountId, $amount)
    {
        $where = [
            'type' => TransactionType::CashoutPIX,
            'amount' => $amount,
            'accounts_id' => $accountId
        ];
        return Transaction::where($where)->orderBy("id", "desc")->first();
    }

    function getLastBetFungames()
    {
        return FungamessGameGains::where("event_type", FungamesEventType::BetPlacing)->orderBy("id", "desc")->first();
    }

    function _userCanDeposit()
    {
        $amount = $this->sortMoneyNumber(1000, 2000);

        $user = $this->lastUser();
        $account = $user->accounts()->first();
        $oldBalance = $account->balance;
        $expectedNewBalance = safeSum($oldBalance, $amount);
        $transaction = $this->addDepositToUser($user, $amount);
        $transactionExists = isset($transaction['id']);
        $this->assertTrue($transactionExists, "The deposit transaction was not created.");
        $this->assertEquals($amount, $transaction['amount'], "The transaction amount does not match.");
        $confirmDeposit = new ConfirmDeposit();
        $transaction = $confirmDeposit->action($transaction['id']);
        $account = $user->accounts()->first();
        $this->assertEquals($account->balance, $expectedNewBalance, "The amount deposited does not match.");


    }

    public function checkExpectedBalance($accountId, $expectedBalance)
    {
        $account = Account::where("id", $accountId)->firstOrFail();
        registerLogMessage("3 Account id:$accountId Balance:" . $account->balance . " Expected: " . $expectedBalance);
        $this->assertEquals($expectedBalance, $account->balance, "The balance is different than expected.");
    }

    public function getRandonPercent()
    {
        $n = rand(1, 1000);
        return safeDiv($n, 100);
    }

    public function getUserAndAccount()
    {
        $user = $this->generateRandomUser();
        $account = $user->accounts()->first();
        return ['user' => $user, 'account' => $account];
    }

}
