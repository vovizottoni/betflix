<?php

namespace App\Http\Livewire\Games;

use Livewire\Component;


//Libs utilizadas
use Illuminate\Support\Facades\Auth;


//Models Utilizadas
use App\Models\Account;


class Games extends Component
{

    public function mount()
    {
        //se usuario está logado e nao selecionou uma account, direciona p/ tela de 'selecionar account'
        if (Auth::check()) {
            $account_id = getAccountIdSession();
            if (empty($account_id)) {
                return redirect()->route('player.accounts');
            }
        }
    }

    public function render()
    {
        return view('livewire.games.games');
    }
}
