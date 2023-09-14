<?php

namespace App\Http\Controllers;

use App\Enums\FungamesDirection;
use App\Enums\FungamesEventType;
use App\Events\BetLoseEvent;
use App\Events\BetWinEvent;
use App\Jobs\AfterFunBetJob;
use App\Services\FungamesWebhookService;
use Illuminate\Http\Request;


//libs
use Illuminate\Support\Facades\DB;


//Models Utilizadas
use App\Models\Account;
use App\Models\TokenAccount;
use App\Models\Game;
use App\Models\Bet;
use App\Models\User;
use App\Models\Group;
use App\Models\Bonus;
use App\Models\FungamessGameGains;
use App\Models\FungamessGames;
use App\Models\CommandBonus3Processamento__;


class FungamessController extends Controller
{
    private $funGameService;

    public function __construct()
    {
        $requestData = \request();
        $this->funGameService = new FungamesWebhookService($requestData);
    }

    public function sessionCheck()
    {
        return $this->funGameService->sessionCheck();
    }

    public function playerDetails()
    {
        return $this->funGameService->playerDetails();

    }

    public function getBalance()
    {
        return $this->funGameService->getBalance();
    }

    public function moveFunds()
    {
        return $this->funGameService->moveFunds();
    }

    public function betFunds()
    {
        return $this->funGameService->betFunds();

    }

    public function getUserToken()
    {
        return $this->funGameService->getUserToken();

    }


}
