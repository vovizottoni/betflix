<?php

namespace App\Listeners;

use App\Enums\TransactionType;
use App\Events\DepositRequest;
use App\Jobs\PayFirstDepositBonus;
use App\Mail\CashInPixWaitingForPayment;
use App\Notifications\NewDepositNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DepositRequestListener
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
     * @param \App\Events\DepositRequest $event
     * @return void
     */
    public function handle(DepositRequest $event)
    {
        $transaction = $event->transaction;
        $user = $transaction->account()->first()->user()->first();
        if ($transaction->type == TransactionType::CashinPIX) {
            $extraData = $transaction->getExtraDataAsArray();
            $emailObject = new CashInPixWaitingForPayment(
                __('mail.subject_cashIn_pix_waiting_for_payment'), $extraData);
            sendEmailOnQueue($user->email, $emailObject);

        }
    }
}
