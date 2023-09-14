<?php

namespace App\Http\Livewire\Admin\Fungamess;

use Livewire\Component;
use Carbon\Carbon;
use Cache;

use App\Models\User;
use App\Models\FungamessProviders;
use App\Models\FungamessGames;

class Users extends Component
{
    public $users;
    public $search;

    public function mount()
    {
        $this->users = User::where([['active', '=', 's']])->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        $users = false;
        if($this->search != '' && strlen($this->search) >= 3){
            $this->users = User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orWhere('cpf', 'like', '%'.$this->search.'%')
                ->where([['active', '=', 's']])
                ->orderBy('name', 'asc')
                ->get();
        }else{
            $this->users = User::where([['active', '=', 's']])->orderBy('name', 'asc')->get();
        }

        return view('livewire.admin.fungamess.users', [
            'users' => $this->users
        ]);
    }

    public function blockOrUnlock($id, $blocked)
    {
        $status = 0;
        if($blocked == 0){
            $status = 1;
        }

        User::where([['id', '=', $id]])->update(['fungamess_user_blocked' => $status]);
    }
}