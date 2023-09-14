<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;

class AdminTransactionsCoingate extends Component
{

    public function render()
    {
        $columns = new AdminTransactionsCoingateDataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.transactions.admin-transactions-coingate', [
            'columns' => $columns,
        ]);
    }
}
