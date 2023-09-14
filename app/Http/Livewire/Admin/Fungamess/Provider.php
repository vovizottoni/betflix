<?php

namespace App\Http\Livewire\Admin\Fungamess;

use Livewire\Component;
use Carbon\Carbon;
use Cache;

use App\Models\User;
use App\Models\FungamessProviders;
use App\Models\FungamessGames;

class Provider extends Component
{
    public $providers;

    public function mount()
    {
        $this->listProviders();
    }

    public function render()
    {
        return view('livewire.admin.fungamess.provider');
    }

    public function activeInactive($id, $active)
    {
        $status = 0;
        if($active == 0){
            $status = 1;
        }

        FungamessProviders::where([['id', '=', $id]])->update(['active' => $status]);
    }

    public function homePage($id, $active)
    {
        $status = 0;
        if($active == 0){
            $status = 1;
        }

        FungamessProviders::where([['id', '=', $id]])->update(['home_page' => $status]);
        $this->listProviders();
    }

    private function listProviders()
    {
        $this->providers = FungamessProviders::orderBy('home_page', 'desc')->with('games')->orderBy('name', 'asc')->get();
    }
}