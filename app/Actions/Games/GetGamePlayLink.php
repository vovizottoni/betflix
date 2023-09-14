<?php

namespace App\Actions\Games;

use App\Enums\GameProvider;
use App\Helpers\FunGamesApi;
use App\Helpers\HypeTechApi;
use App\Models\FungamessGames;
use App\Models\Game;
use App\Models\TokenAccount;
use Ramsey\Uuid\Uuid;

class GetGamePlayLink
{
    private $provider;
    private $balanceUsed;
    private $game;
    private $account;


    private function checkTokenAccount($account, $gameCode)

    {
        $tokenAccount = $account->getTokenAccountByGame($gameCode);
        if (isset($tokenAccount['id']) && !empty($tokenAccount['url']) && !$tokenAccount->isExpired()) {
            return $tokenAccount;
        } else {
            return null;
        }
    }


    public function get($provider, $gameCode, $balanceUsed, $account): ?TokenAccount
    {
        $tokenAccount = $this->checkTokenAccount($account, $gameCode);
        if (isset($tokenAccount['id'])) {
            return $tokenAccount;
        }
        $where = ['game_code' => $gameCode];
        if ($provider == GameProvider::FunGames) {
            $game = FungamessGames::where($where)->firstOrFail();
        } else {
            $game = Game::where($where)->firstOrFail();
        }
        $tokenAccountCreated = getTokenAccountCode();
        $isFungamess = false;

        if ($provider == GameProvider::FunGames) {
            $isFungamess = true;
        }
        $tokenData = TokenAccount::create(['accounts_id' => $account['id'],
            'tokenu' => $tokenAccountCreated,
            'game_code' => $gameCode,
            'balance_used' => $balanceUsed,
            'is_fungamess' => $isFungamess
        ]);

        if ($provider == GameProvider::FunGames) {
            $api = new FunGamesApi($game);
            $url = $api->getLink($account->users_id, $tokenAccountCreated);
            $tokenData->url = $url;
            $tokenData->saveOrFail();
        } else {
            $api = new HypeTechApi($game);
            $data = $api->requestAccess($account);

            $tokenData->url = $data['url'];
            $tokenData->tokenu = $data['token'];
            $tokenData->saveOrFail();

        }
        return $tokenData;


    }

}
