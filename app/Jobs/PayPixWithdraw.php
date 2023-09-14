<?php

namespace App\Jobs;

use App\Enums\TransactionStatus;
use App\Helpers\PagStarApi;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayPixWithdraw implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->transaction = Transaction::whereId($this->transaction->id)->first();
        if ($this->transaction->canBeAutoPaid()) {
            $extraData = $this->transaction->getExtraDataAsArray();
            $amount = $this->transaction->amount;
            $maxAutoValue = (float)getMetaValue("max_amount_cashout_automatic_approval");
            if ($amount > $maxAutoValue) {
                throw new \Exception("Withdrawal not enabled for automatic payment.");
            }
            if (!isset($extraData['document']) || !isset($extraData['amount'])) {
                throw new \Exception("Withdrawal not enabled for automatic payment.");
            }
            $extraData['pix_key'] = decrypt($extraData['pix_key']);
            $extraData['document'] = decrypt($extraData['document']);
            $extraData['amount'] = decrypt($extraData['amount']);
            if ($extraData['amount'] <> $amount) {
                throw new \Exception("Integrity error. The values do not match.");
            }
            $transactionService = new TransactionService();
            $transactionService->payPixWithdrawal($this->transaction);
        } else {
            throw new \Exception("Withdrawal not enabled for automatic payment.");
        }


    }

}
