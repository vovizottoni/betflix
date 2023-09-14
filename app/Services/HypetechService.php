<?php

namespace App\Services;

use App\Enums\HypetechResults;
use App\Events\BetLoseEvent;
use App\Events\BetWinEvent;
use App\Exceptions\HypetechException;
use App\Exceptions\NotEnoughMoneyException;
use App\Models\Account;
use App\Models\Bet;
use App\Models\Game;
use App\Models\TokenAccount;
use Illuminate\Http\Request;

class HypetechService
{
    public function processBetResult(Request $req, $result)
    {
        $betid = $req->get('provider_tx_id');
        $checkBet = Bet::where("bet_code", $betid)->first();

        if (!isset($checkBet['id'])) {
            $errorCode = $this->getNotFoundExceptionCode($result);
            throw new HypetechException("Bet not found", 404, $errorCode, 'n');
        }
        if ($checkBet->result == HypetechResults::Pending) {
            if ($result == HypetechResults::Green) {
                $award = $req->get('amount');
                $betWinData = $this->processBetWin($checkBet, $award);
                return $this->successResponse($req, $betWinData['new_balance'], $betWinData['old_balance']);
            } elseif ($result == HypetechResults::Canceled) {
                $betData = $this->processBetRollback($checkBet);
                return $this->successResponse($req, $betData['new_balance'], $betData['old_balance']);
            } elseif ($result == HypetechResults::Red) {
                return $this->processBetLose($checkBet);
            } else {
                throw new HypetechException("Invalid result", 401, 107, "n");
            }
        } else {
            if ($result == HypetechResults::Canceled) {
                throw new HypetechException("This bet has already been Canceled", 401, 178, 'n');
            } else {
                throw new HypetechException("This bet has already been finalized", 401, 108, 'n');
            }
        }


    }

    private function successResponse(Request $req, $newbalance, $oldBalance, $betId = null)
    {
        $responseData = [
            'new_balance' => $newbalance,
            'old_balance' => $oldBalance,
            'user_id' => $req->get('user_id'),
            'currency' => $req->get('currency'),
            'provider' => $req->get('provider'),
            'provider_tx_id' => $req->get('provider_tx_id')
        ];
        if (!is_null($betId)) {
            $responseData['operator_tx_id'] = $betId;
        }
        return response()->json($responseData, 200);
    }

    private function processBetRollback(Bet $checkBet)
    {
        $transactionCode = $checkBet->getTransactionCode();

        $checkBet->result = HypetechResults::Canceled;
        $checkBet->saveOrFail();
        $balanceUsed__ = $checkBet->balance_used;
        $account = $checkBet->account()->firstOrFail();
        $oldBalance=$account->{$balanceUsed__};

        $amount = $checkBet->amount;

        $account = $account->addBalance($balanceUsed__, $amount, $transactionCode);
        $newBalance=$account->{$balanceUsed__};

        return ['bet_id' => $checkBet->id, 'new_balance' =>$newBalance, 'old_balance' => $oldBalance];
    }

    private function processBetLose(Bet $checkBet)
    {
        $checkBet->result = HypetechResults::Red;
        $checkBet->saveOrFail();
        BetLoseEvent::dispatch($checkBet->accounts_id, $checkBet->amount, $checkBet->balance_used, null);
        return response()->json([
            'msg' => 'Bet sent successfully',
            'code' => '199',
            'stored_result' => 'y'
        ], 200);
    }

    private function processBetWin(Bet $checkBet, $award)
    {
        $transactionCode = $checkBet->getTransactionCode();
        $amount___ = (string)$checkBet->amount;
        $odd_______ = safeDiv($award, $amount___);

        $checkBet->result = HypetechResults::Green;
        $checkBet->odd = $odd_______;
        $checkBet->saveOrFail();

        $balanceUsed__ = $checkBet->balance_used;

        $account = $checkBet->account()->firstOrFail();

        $lucro___ = safeSub($award, $amount___);

        $oldBalance = $account->{$balanceUsed__};
        $account = $account->addBalance($balanceUsed__, $award, $transactionCode);
        $newBalance = $account->{$balanceUsed__};
        BetWinEvent::dispatch($checkBet->accounts_id, $lucro___, $checkBet->balance_used, null);
        return ['bet_id' => $checkBet->id, 'new_balance' => $newBalance, 'old_balance' => $oldBalance];


    }

    public function getNotFoundExceptionCode($result)
    {
        if ($result == HypetechResults::Canceled) {
            return 175;
        }
        return 105;

    }

    public function processRegister(Request $req)
    {
        $tokenu = $req->get('session_token');
        $amount = $req->get('amount');
        $odd = 0.0;
        $checkTokenu = TokenAccount::whereTokenu($tokenu)->first();
        if (empty($checkTokenu)) {
            throw new HypetechException("Invalid token", 401, 401, null);
        } else {
            $account = $checkTokenu->account()->firstOrFail();
            $game = $checkTokenu->getGameData();
            $balanceUsed__ = $checkTokenu->balance_used;
            $balanceAccount = $account->{$balanceUsed__};
            if (!is_numeric(($balanceAccount))) {
                throw new HypetechException("Insufficient funds", 401, 401, null);
            }
            $oldBalance = $account->{$balanceUsed__};
            $account = $account->removeBalanceAndCheckfunds($balanceUsed__, $amount);
            $newBalance = $account->{$balanceUsed__};

            $lastBalanceModel = $account->getLastBalanceModel();
            $betModel = new Bet();
            $betModel->games_id = $game->id;
            $betModel->accounts_id = $account->id;
            $betModel->amount = $amount;
            $betModel->odd = $odd;
            $betModel->result = HypetechResults::Pending;
            $betModel->balance_used = $balanceUsed__;
            $betModel->bet_code = $req->get('provider_tx_id');
            $betModel->tokenu_hypetech = $tokenu;
            $betModel->saveOrFail();
            if (isset($lastBalanceModel['id'])) {
                $lastBalanceModel->code = $betModel->getTransactionCode();
                $lastBalanceModel->save();
            }
            return $this->successResponse($req, $newBalance,$oldBalance, $betModel->id);

        }

    }

    public function processRequest(Request $req, $callback)
    {
        try {
            $callback($req, $this);
        } catch (HypetechException $exception) {
            return response()->json($exception->getResponseArr(), $exception->getHttpCode());
        } catch (NotEnoughMoneyException $exception) {
            return response()->json([
                'msg' => 'Unauthorized bet',
                'code' => '401',
            ], 401);
        }

    }
}
