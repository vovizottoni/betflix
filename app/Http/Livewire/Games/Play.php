<?php

namespace App\Http\Livewire\Games;

use App\Enums\GameProvider;
use App\Models\FungamessGames;
use App\Models\Game;
use App\Models\User;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Account;


class Play extends Component
{
    public $provider;
    public $gameCode;
    private $game;
    private $user;

    public function mount()
    {
        $this->user = Auth::user();

        //se usuario está logado e nao selecionou uma account, direciona p/ tela de 'selecionar account'
        if (!$this->user->hasSelectedAccount()) {
            return redirect()->route('player.accounts');
        }
        if ($this->provider == GameProvider::FunGames) {
            $this->checkUserIsBlockedInFungamess($this->user);
        }




    }

    public function render()
    {
        dd("Ops");
        return view('livewire.games.play');
    }

    private function checkUserIsBlockedInFungamess($user)
    {
        if (!empty($user->fungamess_user_blocked)) {
            header('Location:/');
            exit;
        }
    }

    public function getIframeUrl()
    {

    }
}
