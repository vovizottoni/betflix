<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Player\Accounts;
use App\Models\User;
use Livewire\Component;

class Grid extends Component
{

    public function render()
    {
        return view('livewire.admin.grid');
    }
}
