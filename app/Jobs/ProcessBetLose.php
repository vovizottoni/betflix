<?php

namespace App\Jobs;

use App\Bonus\Bonus3;
use App\Http\Controllers\FungamessController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessBetLose implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $accountId;
    private $amount;
    private $balance_used;
    private $fungamessGamesGainsId;

    public function __construct($accountId, $amount, $balance_used, $fungamessGamesGainsId)
    {
        $this->accountId = $accountId;
        $this->amount = $amount;
        $this->balance_used = $balance_used;
        $this->fungamessGamesGainsId = $fungamessGamesGainsId;
        $this->onQueue(defaultTransactionsQueue());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $bonus3 = new Bonus3();
            $bonus3->betLose($this->accountId, $this->amount, $this->balance_used, $this->fungamessGamesGainsId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }
}
