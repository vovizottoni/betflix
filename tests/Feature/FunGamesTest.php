<?php

namespace Tests\Feature;

use App\Actions\Games\GetGamePlayLink;
use App\Enums\BalanceUsedEnum;
use App\Enums\FungamesDirection;
use App\Enums\FungamesEventType;
use App\Enums\GameProvider;
use App\Models\FungamessGames;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\HelpTestTrait;
use Tests\TestCase;
use Tests\Traits\FunGamesTestTrait;

class FunGamesTest extends TestCase
{
    use FunGamesTestTrait;
    use HelpTestTrait;

    private $balanceUsed;


    function testCanGetIframeLink()
    {
        $this->provider = GameProvider::FunGames;
        $this->balanceUsed = BalanceUsedEnum::Balance;

        $this->assertTrue($this->getIframeLink());
    }

    /**
     * @depends testCanGetIframeLink
     */
    function testCanCheckSession()
    {
        $token = $this->lastTokenAccount();

        $this->assertTrue($this->sessionCheck($token));
    }

    /**
     * @depends testCanCheckSession
     */
    function testCanNotCheckSessionWithInvalidSing()
    {
        $token = $this->lastTokenAccount();
        $this->assertFalse($this->sessionCheck($token, false));
    }

    /**
     * @depends testCanNotCheckSessionWithInvalidSing
     */
    function testCanGetPlayerDetails()
    {
        $token = $this->lastTokenAccount();

        $this->assertTrue($this->getPlayerDetails($token));
    }

    /**
     * @depends testCanGetPlayerDetails
     */
    function testCanGetBalance()
    {
        $token = $this->lastTokenAccount();

        $this->assertTrue($this->getBalance($token));
    }

    /**
     * @depends testCanGetBalance
     */
    function testCanNotBetWithoutBalance()
    {
        $tokenAccount = $this->lastTokenAccount();
        $account = $tokenAccount->account()->first();
        $balance = $account->balance + 0.01;
        $response = $this->betPlacing($tokenAccount, $balance);

        $this->assertFalse($response['status']);
    }

    /**
     * @depends testCanGetBalance
     */
    function testeUserCanDeposit()
    {
        $this->_userCanDeposit();
    }

    /**
     * @depends testeUserCanDeposit
     */
    function testCanBetWithBalance()
    {
        $betAmount = $this->sortMoneyNumber(1, 59);
        $tokenAccount = $this->lastTokenAccount();
        $account = $tokenAccount->account()->first();


        $accountId = $account['id'];
        $balance = $account->balance;
        registerLogMessage("1 Account id:$accountId Balance:$balance Amount: $betAmount");

        $expectedNewBalance = safeSub($balance, $betAmount);
        registerLogMessage("2 Account id:$accountId Balance:$balance Expected: $expectedNewBalance");

        $response = $this->betPlacing($tokenAccount, $betAmount);
        $this->assertTrue($response['status']);

        $this->checkExpectedBalance($accountId, $expectedNewBalance);
    }

    /**
     * @depends testCanBetWithBalance
     */
    function testUserCanWin()
    {
        $lastBetPlase = $this->getLastBetFungames();
        $tokenAccount = $lastBetPlase->getTokenAccount();
        $account = $tokenAccount->account()->first();

        $betAmount = safeMul($lastBetPlase['amount'], 2);

        $balance = $account->balance;
        $expectedNewBalance = safeSum($balance, $betAmount);
        $response = $this->betWin($tokenAccount, $lastBetPlase);
        $this->assertTrue($response['status']);
        //update balance
        $this->checkExpectedBalance($account['id'], $expectedNewBalance);
    }

    /**
     * @depends testUserCanWin
     */
    function testUserCanLoss()
    {
        $lastBetPlase = $this->getLastBetFungames();
        $tokenAccount = $lastBetPlase->getTokenAccount();
        $account = $tokenAccount->account()->first();
        $amount = 0;
        $balance = $account->balance;
        $expectedNewBalance = safeSub($balance, $amount);
        $response = $this->betLose($tokenAccount, $lastBetPlase, $amount);
        $this->assertTrue($response['status']);
        //update balance
        $this->checkExpectedBalance($account['id'], $expectedNewBalance);
    }
    /**
     * @depends testUserCanLoss
     */
    function testCannotDuplicateBetWin()
    {
        $lastBetPlase = $this->getLastBetWinFungames();
        $tokenAccount = $lastBetPlase->getTokenAccount();
        $account = $tokenAccount->account()->first();
        $betAmount = $lastBetPlase->amount;

        $balance = $account->balance;
        $expectedNewBalance = $balance;
        $transactionId=$lastBetPlase['transaction_id'];
        $response = $this->betWin($tokenAccount, $lastBetPlase, $transactionId);
        $this->assertFalse($response['status']);
        //update balance
        $this->checkExpectedBalance($account['id'], $expectedNewBalance);
    }


}
