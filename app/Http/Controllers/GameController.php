<?php

namespace App\Http\Controllers;

use App\Actions\Games\GetGamePlayLink;
use App\Enums\GameProvider;
use App\Exceptions\SoftException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    private function play($provider, $code)
    {
        $user = $this->getUser();
        if (!$user->hasSelectedAccount()) {
            return redirect()->route('player.accounts');
        }


        $pageData = [
            'provider' => $provider,
            'game_code' => $code,
            'ajax_url' => route("game.play", ['provider' => $provider, 'code' => $code])
        ];
        return view("livewire.games.game-layout", $pageData);
    }

    private function getUser()
    {
        return Auth::user();
    }

    public function playHypeLegacy($code = null)
    {
        if (!Auth::check()) {
            return redirect("/login");
        }
        $user = $this->getUser();


        return $this->play(GameProvider::HypeTech, $code);
    }


    public function playFgames($code)
    {
        if (!Auth::check()) {
            return redirect("/login");
        }
        $user = $this->getUser();


        if (!empty($user->fungamess_user_blocked)) {
            return redirect("/");
        }

        return $this->play(GameProvider::FunGames, $code);
    }

    public function getGameUrl($provider, $code)
    {
        try {
            $provider = ucfirst(strtolower($provider));
            $user = $this->getUser();
            $accountId = getAccountIdSession();
            $balanceUsed = session()->get('balanceUsed');
            $account = $user->accounts()->where("id", $accountId)->firstOrFail();

            if (!in_array($provider, GameProvider::getValues())) {
                abort(404);
            }
            if (GameProvider::FunGames == $provider && !empty($user->fungamess_user_blocked)) {
                throw new SoftException(__("cashout.msg_erro_falha_na_requisicao"));
            }
            if (!$user->hasSelectedAccount()) {
                throw new SoftException(__("cashin.selecione_uma_conta"));
            }

            $action = new GetGamePlayLink();
            $data = $action->get($provider, $code, $balanceUsed, $account);
            //se usuario está logado e nao selecionou uma account, direciona p/ tela de 'selecionar account'

            if ($provider == GameProvider::FunGames && !empty($user->fungamess_user_blocked)) {
                return redirect("/");
            }
            $response = [];
            $response['url'] = $data['url'];
            $response['game_code'] = $data['game_code'];
            $response['balance_used'] = $data['balance_used'];
            return apiSuccessMessage($response);
        } catch (\Exception $e) {
            return apiErrorMessage($e->getMessage());
        }


    }
}
