<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ShowBets extends Component
{   use WithPagination;
    public $transactionID;
    public function render()
    {

        $transactions = DB::table('transactions')
        ->join('accounts', 'transactions.accounts_id', '=', 'accounts.id')
        ->join('users', 'accounts.users_id', '=', 'users.id')
        ->where('users.id', $this->transactionID)
        ->select('transactions.*')
        ->orderBy('created_at')
        ->paginate(30);
        return view('livewire.admin.user.show-bets', [
            'transactions' => $transactions
        ]);
    }

}
