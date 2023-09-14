<?php

namespace App\Http\Livewire\Admin\User;

// models utilizadas

use App\Models\Account;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;
use App\util\Util;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


//pagination
use Livewire\WithPagination;

// DataTable

class Manageruser extends Component
{

    public $arr_accounts_user;
    public $is_active__;
    public $is_not_active__;


    public function mount()
    {
        $this->is_active__ = User::where('active', 's')->count();
        $this->is_not_active__ = User::where('active', 'n')->count();
    }

    public function render()
    {

        $columns = new UserDataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.user.manageruser', [
            // 'users' => $users,
            'columns' => $columns,
        ]);
    }
}
