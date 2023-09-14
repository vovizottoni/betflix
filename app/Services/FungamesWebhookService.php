<?php

namespace App\Services;

use App\Enums\FungamesDirection;
use App\Enums\FungamesEventType;
use App\Events\BetLoseEvent;
use App\Events\BetWinEvent;
use App\Exceptions\DuplicatedTransactionException;
use App\Exceptions\NotEnoughMoneyException;
use App\Exceptions\SoftException;
use App\Exceptions\TokenNotFoundException;
use App\Exceptions\UnknownErrorException;
use App\Http\Livewire\Player\Accounts;
use App\Models\Account;
use App\Models\FungamessGameGains;
use App\Models\FungamessGames;
use App\Models\TokenAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FungamesWebhookService
{
    public $req;
    private $requestData;
    private $tokenAccount;
    private $account;
    private $user;
    private $game;
    private $gameId;

    public function __construct(?Request $req)
    {
        $data = $req->all();
        if (empty($data) || !is_array($data)) {
            throw new \Exception("Invalid data");
        }

        $this->requestData = $data;

        $this->req = $req;
    }

    public function getUserid($userId)
    {

        if ($this->tokenAccount->hasSuffix()) {
            return $userId . fungamesSufix();
        }
        return $userId;
    }

    public function getCleanUserId()
    {
        $data = $this->requestData;
        if (isset($data['userId'])) {
            $parts = explode("_", $data['userId']);
            return getOnlyNumbers($parts[0]);
        }
        return 0;
    }

    public function hasTokenOrFail()
    {
        $tokenu = $this->getTokenRequest();
        $token = TokenAccount::where("tokenu", $tokenu)->first();
        if (!isset($token['tokenu'])) {
            throw new TokenNotFoundException('Token account not found "' . $tokenu . '" ');
        }
    }

    public function getTokenRequest()
    {
        if (!isset($this->requestData['token'])) {
            throw new \Exception('Token account not found');
        }
        return $this->requestData['token'];
    }

    public function getTokenOrFails(): TokenAccount
    {

        if (is_null($this->tokenAccount)) {
            $tokenu = $this->getTokenRequest();
            $tokenAccount = TokenAccount::where("tokenu", $tokenu)->first();
            if (!isset($tokenAccount['id'])) {
                throw new \Exception('Token account not found');
            }
            $this->tokenAccount = $tokenAccount;
        }
        return $this->tokenAccount;

    }

    public function getAccountOrFails(): Account
    {
        if (is_null($this->account)) {
            $token = $this->getTokenOrFails();
            return $token->account()->firstOrFail();
        } else {
            return $this->account;
        }
    }

    public function getUserOrFail(): User
    {
        if (is_null($this->user)) {
            $account = $this->getAccountOrFails();
            $this->user = $account->user()->firstOrFail();
        }
        return $this->user;
    }

    public function getGameIdOrFail(): ?int
    {
        if (is_null($this->gameId)) {
            $game = $this->getGameOrFail();
            $this->gameId = $game['id'];
        }
        return $this->gameId;
    }

    public function getGameOrFail(): FungamessGames
    {
        if (is_null($this->game)) {
            if (isset($this->requestData['gameId'])) {
                $game = FungamessGames::where("game_id", $this->requestData['gameId'])->first();
            }
            if (!isset($game['id'])) {
                $token = $this->getTokenOrFails();
                $gameCode = $token->game_code;
                $game = FungamessGames::where("game_code", $gameCode)->first();
            }
            $this->game = $game;
            $this->gameId = $this->game['id'];
        }
        return $this->game;
    }

    public function validateAmountOrFail()
    {
        $data = $this->requestData;
        if (isset($data['amount']) && is_numeric($data['amount']) && $data['amount'] >= 0) {
            return true;
        } else {
            throw new UnknownErrorException("Invalid amount format.");
        }

    }

    public function saveApiResponse()
    {
        $gameId = $this->getGameIdOrFail();
        $requestData = $this->requestData;
        if (!isset($requestData['extraData']) || !is_array($requestData['extraData'])) {
            $requestData['extraData'] = [];
        }
        $time = isset($requestData['time']) ? $requestData['time'] : date('Y-m-d H:i:s');

        $fungamessGame = new FungamessGameGains();
        $fungamessGame->token = $requestData['token'];
        $fungamessGame->users_id = $this->getCleanUserId();
        $fungamessGame->game_id = $gameId;
        $fungamessGame->extra_data = json_encode($requestData['extraData']);
        $fungamessGame->event_id = $requestData['eventId'];
        $fungamessGame->direction = $requestData['direction'];
        $fungamessGame->transaction_id = $requestData['transactionId'];
        $fungamessGame->event_type = $requestData['eventType'];
        $fungamessGame->amount = $requestData['amount'];
        $fungamessGame->time = $time;
        $fungamessGame->saveOrFail();
        return $fungamessGame;

    }

    private function validateRequiredApiResponse()
    {
        $requestData = $this->requestData;
        $requireds = ['userId', 'eventId', 'direction', 'transactionId', 'eventType', 'amount'];
        foreach ($requireds as $requiredInput) {
            if (!isset($requestData[$requiredInput]) || empty($requestData[$requiredInput])) {
                throw new \Exception("$requiredInput input not found");
            }
        }
    }

    public function getRequestHash($data)
    {
        return getFunGamesHash($data);
    }

    public function checkSign()
    {
        $errorMsg = "Error sign.";
        $hashAuth = $this->req->header('Hash-Authorization');

        if (is_null($hashAuth) || empty($hashAuth)) {
            throw new UnknownErrorException($errorMsg);
        }
        $data = $this->requestData;
        $hashAuthLocal = $this->getRequestHash($data); // Hashing of data
        if ($hashAuthLocal !== $hashAuth) {
            throw new UnknownErrorException($errorMsg);
            return true;
        }
        return false;
    }

    public function processEvents(Account $account, $balanceUserName)
    {
        $dados = $this->requestData;

        $allowedEvents = [FungamesEventType::BetPlacing, FungamesEventType::Win];

        if (isset($dados['eventType']) && in_array($dados['eventType'], $allowedEvents)) {

            $where = [
                'event_id' => $dados['eventId'],
                'event_type' => $dados['eventType']
            ];
            $gameGains = FungamessGameGains::select(["id", 'amount'])->where($where)->first();
            if (!isset($gameGains['id'])) {
                throw new \Exception("Invalid game gains: " . json_encode($where));
            }
            if ($dados['eventType'] == FungamesEventType::BetPlacing) {
                BetLoseEvent::dispatch($account->id, $gameGains->amount, $balanceUserName, $gameGains->id);
            } else {
                BetWinEvent::dispatch($account->id, $dados['amount'], $balanceUserName, $gameGains->id);
            }
        }

    }

    public function playerDetails()
    {
        $callback = function ($instance) {
            $checkToken = $instance->getTokenOrFails();
            $account = $checkToken->account()->select(["id", 'users_id', 'name'])->firstOrFail();
            return [
                'status' => true,
                'userId' => $this->getUserid($account->users_id), // colocar o # account_id
                'nickname' => $account->name,
                'currency' => 'BRL',
                'language' => 'pt'
            ];
        };
        return $this->apiResponse($callback);

    }

    public function moveFunds()
    {
        //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
        $callback = function ($instance) {
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
            $dados = $instance->req->all();
            $logFile = $dados['transactionId'];

            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            $checkTokenu = $instance->getTokenOrFails();
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            $account = $instance->getAccountOrFails();
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            $instance->validateAmountOrFail();
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            // Atualiza saldo do usuário
            // direction: debit/credit
            $balanceUserName = $checkTokenu->balance_used;
            if (isset($dados['amount']) && $dados['amount'] == 0 && isset($dados['eventType']) && $dados['eventType'] == FungamesEventType::Lose) {
                return [
                    'status' => true,
                    'balance' => $account->{$balanceUserName}
                ];
            }

            $gameGains = FungamessGameGains::where("transaction_id", $dados['transactionId'])->first();
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            $hasTransaction = isset($gameGains['id']);
            if ($hasTransaction) {
                throw new DuplicatedTransactionException($account->{$balanceUserName});
            }
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            // Salva o retorno da api
            $instance->saveApiResponse();
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            if ($dados['direction'] == FungamesDirection::Credit) {
                //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
                $account = $account->addBalance($balanceUserName, $dados['amount']);
                //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
            } elseif ($dados['direction'] == FungamesDirection::Debit) {
                if (isset($dados['eventType']) && $dados['eventType'] == FungamesEventType::BetPlacing) {
                    //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
                    $account = $account->removeBalanceAndCheckfunds($balanceUserName, $dados['amount']);
                    //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
                } else {
                    //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
                    $account = $account->removeBalance($balanceUserName, $dados['amount']);
                    //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
                }
            }

            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());
            $instance->processEvents($account, $balanceUserName);
            $this->addBalanceLog($account, $gameGains);
            //registerTransactionLog("#".__LINE__."Curent time: " . execTimeSec());

            return [
                'status' => true,
                'balance' => $account->{$balanceUserName}
            ];
        };
        return $this->apiResponse($callback);
    }

    public function getBalance()
    {
        $callback = function ($instance) {
            $checkToken = $instance->getTokenOrFails();
            $balanceCol = $checkToken->balance_used;
            $account = $checkToken->account()->select("$balanceCol")->firstOrFail();
            return [
                'status' => true,
                'balance' => $account->{$balanceCol}
            ];
        };
        return $this->apiResponse($callback);

    }

    public function getUserToken()
    {
        $callback = function ($instance) {

            $dados = $instance->req->all();

            if (empty($dados)) {
                throw new \Exception("Invalid data");
            }

            $userId = $this->getCleanUserId();
            $user = User::where("id", $userId)->firstOrFail();
            $row = $user->tokenAccounts()->select(['accounts.users_id', 'tokens_accounts.tokenu', 'accounts.balance'])->
            orderBy("tokens_accounts.id", "desc")->firstOrFail();
            if (!isset($row['users_id'])) {
                throw new \Exception("No user found with ID " . $userId);
            }
            return [
                'status' => true,
                'userId' => $this->getUserid($row->users_id),
                'token' => $row->tokenu,
                'balance' => $row->balance
            ];

        };
        return $this->apiResponse($callback);

    }

    public function betFunds()
    {
        $callback = function ($instance) {
            $checkTokenu = $instance->getTokenOrFails();
            $account = $instance->getAccountOrFails();
            $dados = $instance->req->all();
            $eventId = isset($dados['eventId']) ? $dados['eventId'] : 0;
            $tokenu = $checkTokenu->tokenu;
            $gameGains = FungamessGameGains::where([['token', '=', $tokenu], ['event_id', '=', $eventId]])->orderBy('created_at', 'desc')->firstOrFail();
            // Atualiza saldo do usuário
            // direction: debit/credit
            $balanceUserName = $checkTokenu->balance_used;
            if ($gameGains->direction == FungamesDirection::Credit) {
                $account = $account->removeBalance($balanceUserName, $gameGains->amount);
            } elseif ($gameGains->direction == FungamesDirection::Debit) {
                $account = $account->addBalance($balanceUserName, $gameGains->amount);
            }
            $instance->processEvents($account, $balanceUserName);
            $this->addBalanceLog($account, $gameGains);

            return [
                'status' => true,
                'balance' => $account->{$balanceUserName}
            ];
        };
        return $this->apiResponse($callback);

    }

    private function addBalanceLog($account, $gameGains)
    {
        $balanceLogModel = $account->getLastBalanceModel();
        if (isset($balanceLogModel['id'])) {
            $balanceLogModel->code = $gameGains->getTransactionCode();
            $balanceLogModel->save();
        }
    }

    public function sessionCheck()
    {
        $callback = function ($instance) {
            $instance->hasTokenOrFail();
            return ['status' => true];
        };
        return $this->apiResponse($callback);

    }

    public function apiResponse($callback)
    {
        try {

            $this->checkSign();
            $instance = $this;
            $response = $callback($instance);
            return response()->json($response);
        } catch (TokenNotFoundException $e) {

            return funGamesApiError($e->getMessage(), 417);
        } catch (UnknownErrorException $e) {
            return funGamesApiError($e->getMessage(), 400);
        } catch (ModelNotFoundException $e) {
            return funGamesApiError($e->getMessage(), 400);
        } catch (NotEnoughMoneyException $e) {
            return funGamesApiError($e->getMessage(), 402, ['balance' => $e->getBalance()]);
        } catch (DuplicatedTransactionException $e) {
            return funGamesApiError($e->getMessage(), 409, ['balance' => $e->getBalance()]);
        } catch (\Exception $e) {
            return funGamesApiError($e->getMessage(), 400);
        }

    }

}
