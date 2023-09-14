<?php

namespace App\Http\Livewire\Admin\Transactions\CashoutPagstar;

use App\Exceptions\SoftException;
use App\Jobs\PayAdminPixWithdraw;
use App\Jobs\PayPixWithdraw;
use Livewire\Component;

//libs
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

//Emails enviados
use App\Mail\CashOutPixWaitingForWithdraw;
use App\Mail\CashoutApproved;
use App\Mail\CashoutDenied;

//classe util
use App\util\Util;

//models
use App\Models\Transaction;
use App\Models\Account;

use App\Models\User;


class CashoutApproval extends Component
{
    public $approval_cashout = 0;
    public $pending_cashout = 0;
    public $denied_cashout = 0;
    public function mount()
    {
        $this->approval_cashout = $this->approval_cashout();
        $this->pending_cashout = $this->pending_cashout();
        $this->denied_cashout = $this->denied_cashout();
    }

    public function approval_cashout()
    {
        $approval_cashout = Transaction::whereIn('type', ['cashoutPIX'])
            ->where('balance_used', 'balance')
            ->whereIn('status', ['drawee'])
            ->whereIn('cashout_approval', ['approved'])
            ->select('amount')
            ->sum('amount');

        $this->approval_cashout = $approval_cashout;
        return $approval_cashout;
    }

    public function pending_cashout()
    {
        $pending_cashout = Transaction::whereIn('type', ['cashoutPIX'])
            ->where('balance_used', 'balance')
            ->whereIn('status', ['waiting_for_withdraw'])
            ->whereIn('cashout_approval', ['waiting_for_approval'])
            ->select('amount')
            ->sum('amount');

        $this->pending_cashout = $pending_cashout;
        return $pending_cashout;
    }

    public function denied_cashout()
    {
        $denied_cashout = Transaction::whereIn('type', ['cashoutPIX'])
            ->where('balance_used', 'balance')
            ->whereIn('status', ['canceled'])
            ->whereIn('cashout_approval', ['denied'])
            ->select('amount')
            ->sum('amount');

        $this->denied_cashout = $denied_cashout;
        return $denied_cashout;
    }

    public function render()
    {

        $columns = new CashoutApprovalDataTable();
        $columns = $columns->DataTableColumn();



        return view('livewire.admin.transactions.cashout-pagstar.cashout-approval', [
            'columns' => $columns,
        ]);
    }
}
