<?php

namespace App\Http\Livewire\Admin\Rollovers;

//models
use App\Models\Account;
use App\Models\Bet;
use App\Models\Transaction;
use App\Models\User;

//libs
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class RolloverBonus1 extends Component
{

    public function render()
    {

        $columns = new RolloverBonus1DataTable();
        $columns = $columns->DataTableColumn();

 
        return view('livewire.admin.rollovers.rollover-bonus1', [
 
            'columns' => $columns,
        ]);
    }
}
