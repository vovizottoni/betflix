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

class PayAdminPixWithdraw implements ShouldQueue
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
        if ($this->transaction->canBeManualPaid() && $this->transaction->cashout_approval=='approved') {
            $transactionService= new TransactionService();
            $transactionService->payPixWithdrawal($this->transaction);
        } else {
            throw new \Exception("Withdrawal not enabled for manual payment.");
        }

    }
}
