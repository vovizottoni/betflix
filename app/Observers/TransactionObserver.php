<?php

namespace App\Observers;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Mail\CashoutApproved;
use App\Mail\CashoutDenied;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "updated" event.
     *
     * @param \App\Models\Transaction $Transaction
     * @return void
     */
    public function updated(Transaction $Transaction)
    {

        if ($Transaction->type == TransactionType::CashoutPIX) {

            $emailData = $Transaction->getEmailParams();
            $parametros__ = $emailData;
            if ($Transaction->status == TransactionStatus::Canceled) {
                $emailObject = new CashoutDenied(env('MAIL_FROM_ADDRESS'), __('emails.cashout_denied_subject'), $parametros__);
                sendEmailOnQueue($emailData['email'], $emailObject);
            }
            if ($Transaction->status == TransactionStatus::Drawee) {
                $emailObject = new CashoutApproved(env('MAIL_FROM_ADDRESS'), __('emails.cashout_approved_subject'), $parametros__);
                sendEmailOnQueue($emailData['email'], $emailObject);
            }
        }
    }

}
