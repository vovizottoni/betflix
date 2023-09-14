<?php

namespace App\Http\Livewire\Admin\Transactions;

use Livewire\Component;
use Livewire\WithPagination;

//libs
use Illuminate\Support\Carbon;

//models
use App\Models\Transaction;
use App\Models\User;
use App\Models\Account;


//classes ultilitárias
use App\util\Util;

class AdminTransactions extends Component
{
    public $total_in_entries = 0;
    public $total_in_exits = 0;
    public $qty_of_completed_transactions = 0;


    public function mount()
    {

        //estastiticas topo da tela (total em entradas, total em saidas, total em transações)
        $this->total_in_entries = Transaction::where([['type', '=', 'cashinPIX'], ['status', '=', 'paid']])->sum('amount');
        $this->total_in_exits = Transaction::where([['type', '=', 'cashoutPIX'], ['status', '=', 'drawee']])->sum('amount');
        $this->qty_of_completed_transactions = Transaction::where(function ($query) {
            $query->where('status', '=', 'paid')
                ->orWhere('status', '=', 'drawee');
        })->count();
    }

    public function render()
    {

        $columns = new AdminPagstarDataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.transactions.admin-transactions', [
            'columns' => $columns,
        ]);
    }
}
