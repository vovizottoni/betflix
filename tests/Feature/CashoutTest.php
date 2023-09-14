<?php

namespace Tests\Feature;

use App\Enums\TransactionStatus;
use App\Exceptions\DailyCashoutLimitException;
use App\Exceptions\InsufficientFundsException;
use App\Exceptions\MinMaxCashoutException;
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\HelpTestTrait;
use Tests\TestCase;

class CashoutTest extends TestCase
{
    use HelpTestTrait;


    public function testCanNotWithdrawWithoutFunds()
    {
        $newBalance = 0;
        $basicData = $this->getUserAndAccount();
        $user = $basicData['user'];
        $account = $basicData['account'];
        $account->balance = $newBalance;
        $account->saveOrFail();

        $this->expectException(InsufficientFundsException::class);

        $transactionService = new TransactionService();

        $amount = $this->sortMoneyNumber(100);
        $expectedNewAmount = $newBalance;
        $forceIgnoreJob = true;
        $transactionService->processWithDrawal($account, $user->cpf, $amount, $forceIgnoreJob);
        $this->checkExpectedBalance($account['id'], $expectedNewAmount);

    }

    /**
     * @depends testCanNotWithdrawWithoutFunds
     */
    public function testCanNotWithdrawWithoutAllFunds()
    {
        $newBalance = 99.93;
        $basicData = $this->getUserAndAccount();
        $user = $basicData['user'];
        $account = $basicData['account'];
        $account->balance = $newBalance;
        $account->saveOrFail();
        $this->expectException(InsufficientFundsException::class);

        $transactionService = new TransactionService();
        $expectedNewAmount = $newBalance;
        $amount = safeSum($newBalance, 0.01);
        $transactionService->processWithDrawal($account, $user->cpf, $amount);
        $this->checkExpectedBalance($account['id'], $expectedNewAmount);
    }

    /**
     * @depends testCanNotWithdrawWithoutAllFunds
     */
    public function testCanNotWithdrawSmallerOrLargerAmount()
    {
        $minWtd = env("MIN_AMOUNT_WITHDRAW_PIX_BRL");
        $maxWtd = env("MAX_AMOUNT_WITHDRAW_PIX_BRL");
        $newBalance = 99.93;
        $basicData = $this->getUserAndAccount();
        $user = $basicData['user'];
        $account = $basicData['account'];
        $account->balance = $newBalance;
        $account->saveOrFail();

        $amountsToTest = [safeSub($minWtd, 0.01), safeSum($maxWtd, 0.01)];
        foreach ($amountsToTest as $amount) {
            $this->expectException(MinMaxCashoutException::class);
            $transactionService = new TransactionService();
            $expectedNewAmount = $newBalance;
            $forceIgnoreJob = true;
            $transactionService->processWithDrawal($account, $user->cpf, $amount, $forceIgnoreJob);
            $this->checkExpectedBalance($account['id'], $expectedNewAmount);
        }
    }

    /**
     * @depends testCanNotWithdrawWithoutAllFunds
     */
    public function testBigWithdrawalCannotAutoPaid()
    {

        $newBalance = safeSum(getMetaValue("max_amount_cashout_automatic_approval"), 0.01);
        $basicData = $this->getUserAndAccount();
        $user = $basicData['user'];
        $account = $basicData['account'];
        $account->balance = $newBalance;
        $account->saveOrFail();

        $amount = $newBalance;
        $transactionService = new TransactionService();
        $expectedNewAmount = safeSub($account->balance, $amount);

        $forceIgnoreJob = true;
        $transactionService->processWithDrawal($account, $user->cpf, $amount, $forceIgnoreJob);
        $this->checkExpectedBalance($account['id'], $expectedNewAmount);
        $cashout = $this->getLastCashout($account['id'], $amount);
        $this->assertTrue($cashout->isPixPendingCashout());
        $this->assertFalse($cashout->canBeAutoPaid());
    }

    /**
     * @depends testBigWithdrawalCannotAutoPaid
     */
    public function testCannotCreateTwoWithdrawl()
    {
        $newBalance = safeSum(env("MIN_AMOUNT_WITHDRAW_PIX_BRL"), 0.01);
        $user = $this->lastUser();
        $account = $user->accounts()->first();
        $account->balance = $newBalance;
        $account->saveOrFail();

        $amount = $newBalance;
        $transactionService = new TransactionService();
        $expectedNewAmount = $account->balance;

        $forceIgnoreJob = true;
        $this->expectException(DailyCashoutLimitException::class);
        $transactionService->processWithDrawal($account, $user->cpf, $amount, $forceIgnoreJob);
        $this->checkExpectedBalance($account['id'], $expectedNewAmount);
    }

    /**
     * @depends testCannotCreateTwoWithdrawl
     */
    public function testAutoWithdrawCanBePaid()
    {
        /*$newBalance = env("MIN_AMOUNT_WITHDRAW_PIX_BRL");
        $basicData = $this->getUserAndAccount();
        $user = $basicData['user'];
        $account = $basicData['account'];
        $account->balance = $newBalance;
        $account->saveOrFail();
        $user->cpf = "07559659578";
        $user->name = "Caique marcelino souza";
        $user->saveOrFail();

        $amount = $newBalance;
        $transactionService = new TransactionService();
        $expectedNewAmount = safeSub($account->balance, $amount);
        $transactionService->processWithDrawal($account, $user->cpf, $amount);
        $this->checkExpectedBalance($account['id'], $expectedNewAmount);
        $cashout = $this->getLastCashout($account['id'], $amount);
        $this->assertEquals($cashout->status, TransactionStatus::Drawee);*/

    }
}
