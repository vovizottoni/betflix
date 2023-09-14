<?php

namespace App\Listeners;

use App\Events\ConfirmedDeposit;
use App\Jobs\PayFirstDepositBonus;
use App\Mail\CashinPixPaid;
use App\Notifications\ConfirmedDepositNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ConfirmedDepositListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\ConfirmedDeposit $event
     * @return void
     */
    public function handle(ConfirmedDeposit $event)
    {
        $transaction = $event->transaction;
        $account = $transaction->account()->first();
        $user = $account->user()->first();
        if ($transaction->isFirstDeposit()) {
            PayFirstDepositBonus::dispatch($transaction);
        }
        if ($transaction->isPix()) {
            $emailData = ['name' => $user->name, 'account_id_name' => $account->name,
                'value_' => $transaction->amount, 'pixkey' => $account->cpf,
                'transaction_code' => $transaction->transaction_code];
            $emailObject = new CashinPixPaid(__('mail.subject_cashIn_pix_paid'), $emailData);
            sendEmailOnQueue($user->email,$emailObject);

        }


    }
}
