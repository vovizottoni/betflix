<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\FungamessGameGains;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowApostas extends Component
{
    use WithPagination;
    public $betId;
    public function render()
    {
        $gameGains = FungamessGameGains::where('users_id', $this->betId)->orderBy('created_at')
        ->paginate(30);;
        return view('livewire.admin.user.show-apostas', [
            'gameGains' => $gameGains
        ]);
    }
}
