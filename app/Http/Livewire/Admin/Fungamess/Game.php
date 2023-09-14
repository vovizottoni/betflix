<?php

namespace App\Http\Livewire\Admin\Fungamess;

use Livewire\Component;
use Carbon\Carbon;
use Cache;

use App\Models\User;
use App\Models\FungamessProviders;
use App\Models\FungamessGames;

class Game extends Component
{
    public $provider_id;
    public $provider;
    public $games;

    public function mount($provider_id)
    {
        $this->provider_id = $provider_id;

        $this->provider = FungamessProviders::where([['id', '=', $provider_id]])->first();
        $this->listGames($this->provider_id);
    }

    public function render()
    {
        return view('livewire.admin.fungamess.game');
    }

    public function activeInactive($id, $active)
    {
        $status = 0;
        if($active == 0){
            $status = 1;
        }

        FungamessGames::where([['id', '=', $id]])->update(['active' => $status]);
    }

    public function homePage($id, $active)
    {
        $status = 0;
        if($active == 0){
            $status = 1;
        }

        FungamessGames::where([['id', '=', $id]])->update(['home_page' => $status]);
        $this->listGames($this->provider_id);
    }

    private function listGames($provider_id)
    {
        $this->games = FungamessGames::where([['provider_id', '=', $provider_id]])->orderBy('home_page', 'desc')->orderBy('name', 'asc')->get();

    }
}