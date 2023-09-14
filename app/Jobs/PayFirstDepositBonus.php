<?php

namespace App\Jobs;

use App\Bonus\FirstDepositBonus;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayFirstDepositBonus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->onQueue(defaultTransactionsQueue());
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $bonus = new FirstDepositBonus();
        $bonus->pay($this->transaction);
    }
}
