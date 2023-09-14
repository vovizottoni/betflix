<?php

namespace App\Http\Livewire\Fungamess;

use Livewire\Component;


//models utilizadas
use App\Models\FungamessProviders;
use App\Models\FungamessGames;
use App\Models\Game;

class Search extends Component
{
    public $showSearch = false;
    public $search;
    public $jogos_ou_provedores_search = 'games';

    public function mount()
    {
    }

    public function render()
    {
        $games = false;
        $search = '';
        $showSearch = false;
        if($this->search != '' && strlen($this->search) >= 3){
            $this->showSearch = true;
            $search = $this->search;

            if($this->jogos_ou_provedores_search == 'games'){
                //$games = FungamessGames::where('name', 'like', '%'.$this->search.'%')->limit(50)->orderBy('name', 'asc')->get();
                $fun_games = FungamessGames::select('id', 'img','game_code', 'name')->where('name', 'like', '%'.$this->search.'%')->limit(50)->orderBy('name', 'asc');
                $hype_games = Game::select('id', 'image', 'game_code' ,'name')->where('name', 'like', '%'.$this->search.'%')->limit(50)->orderBy('name', 'asc');
                $games = $hype_games->union($fun_games)->get();
            }else{
                $games = FungamessProviders::where('name', 'like', '%'.$this->search.'%')->with('games')->whereNotNull('logo')->limit(50)->get();;

            }
            
        }

        return view('livewire.fungamess.search', [
            'jogos_ou_provedores_search' => $this->jogos_ou_provedores_search,
            'showSearch' => $showSearch,
            'search' => $search,
            'games' => $games
        ]);
    }

    public function jogosProvedoresSearch($option)
    {
        $this->jogos_ou_provedores_search = $option;
    }
}