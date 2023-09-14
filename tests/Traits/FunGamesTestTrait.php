<?php

namespace Tests\Traits;

use App\Enums\FungamesDirection;
use App\Enums\FungamesEventType;
use App\Models\FungamessGameGains;
use App\Models\TokenAccount;
use App\Models\User;
use Illuminate\Support\Facades\Http;

trait FunGamesTestTrait
{
    private $provider;

    function sendRequest($endpoint, $data, $method, $genSignature = true)
    {
        $url = url($endpoint);
        if ($genSignature) {
            $headers = ['Hash-Authorization' => getFunGamesHash($data)];
        } else {
            $headers = ['Hash-Authorization' => 'none'];
        }
        $req = Http::withHeaders($headers);
        $method = strtolower($method);
        $response = $req->{$method}($url, $data)->json();
        registerLogMessage("\n Method: $method Headers:" . json_encode($headers) . " $url: Data:" . json_encode($data) . " Response" . json_encode($response) . " \n \n");
        return $response;
    }

    public function sessionCheck(TokenAccount $tokenAccount, $genSignature = true)
    {
        $basicData = $this->getBasicData($tokenAccount);
        $user = $basicData['user'];

        $endPoint = "webhook/fungamess/sessionCheck";
        $data = [
            'userId' => $user->id,
            'token' => $tokenAccount->tokenu
        ];
        $response = $this->sendRequest($endPoint, $data, "GET", $genSignature);
        if (isset($response['status'])) {
            return $response['status'];
        }
        return false;

    }

    public function getPlayerDetails(TokenAccount $tokenAccount, $genSignature = true)
    {
        $basicData = $this->getBasicData($tokenAccount);
        $user = $basicData['user'];

        $endPoint = "webhook/fungamess/playerDetails";
        $data = [
            'userId' => $user->id,
            'token' => $tokenAccount->tokenu
        ];
        $response = $this->sendRequest($endPoint, $data, "GET", $genSignature);
        if (isset($response['nickname'])) {
            return true;
        }
        return false;
    }

    public function getBalance(TokenAccount $tokenAccount, $genSignature = true)
    {
        $basicData = $this->getBasicData($tokenAccount);
        $user = $basicData['user'];


        $endPoint = "webhook/fungamess/getBalance";
        $data = [
            'userId' => $user->id,
            'token' => $tokenAccount->tokenu
        ];

        $response = $this->sendRequest($endPoint, $data, "GET", $genSignature);
        registerLogMessage(json_encode($response));
        if (isset($response['balance'])) {
            return true;
        }
        return false;
    }

    public function moveFunds($data)
    {
        $endPoint = "webhook/fungamess/moveFunds";
        return $this->sendRequest($endPoint, $data, "POST");

    }

    public function canMoveFunds(TokenAccount $tokenAccount, $genSignature = true)
    {
        $basicData = $this->getBasicData($tokenAccount);
        $user = $basicData['user'];

        $endPoint = "webhook/fungamess/getBalance";
        $data = [
            'userId' => $user->id,
            'token' => $tokenAccount->tokenu
        ];
        $response = $this->sendRequest($endPoint, $data, "GET", $genSignature);
        if (isset($response['balance'])) {
            return true;
        }
        return false;
    }

    public function fundsData(TokenAccount $tokenAccount, $direction, $event, $amount, $genSignature = true, $eventId = null)
    {
        $basicData = $this->getBasicData($tokenAccount);
        $user = $basicData['user'];
        $game = $basicData['game'];
        if (is_null($eventId)) {
            $eventId = rand(11111111, 99999999);

        }
        $transactionId = getUniqueCode();
        return [
            "token" => $tokenAccount->tokenu,
            "userId" => $user->id,
            "gameId" => $game['game_id'],
            "eventId" => $eventId,
            "direction" => $direction,
            "extraData" => [
                "gameName" => $game['name']
            ],
            "transactionId" => $transactionId,
            "eventType" => $event,
            "amount" => $amount
        ];
    }

    public function betPlacing(TokenAccount $tokenAccount, $amount)
    {
        $direction = FungamesDirection::Debit;
        $eventType = FungamesEventType::BetPlacing;
        $data = $this->fundsData($tokenAccount, $direction, $eventType, $amount);
        return $this->moveFunds($data);
    }

    public function betWin(TokenAccount $tokenAccount, FungamessGameGains $gameGain, $transactionId = null)
    {
        $direction = FungamesDirection::Credit;
        $eventType = FungamesEventType::Win;
        $amount = safeMul($gameGain->amount, 2);
        $data = $this->fundsData($tokenAccount, $direction, $eventType, $amount, true, $gameGain['event_id']);
        if (!is_null($transactionId)) {
            $data['transactionId'] = $transactionId;
        }
        return $this->moveFunds($data);
    }

    public function betLose(TokenAccount $tokenAccount, FungamessGameGains $gameGain, $amount)
    {
        $direction = FungamesDirection::Debit;
        $eventType = FungamesEventType::Lose;
        $data = $this->fundsData($tokenAccount, $direction, $eventType, $amount, true, $gameGain['event_id']);
        return $this->moveFunds($data);
    }

    public function getBasicData(TokenAccount $tokenAccount)
    {
        $account = $tokenAccount->account()->first();
        $user = $account->user()->first();
        return ['account' => $account, 'user' => $user, 'game' => $tokenAccount->getGameData()];
    }


}
