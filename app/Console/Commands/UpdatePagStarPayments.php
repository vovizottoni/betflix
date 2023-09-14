<?php

namespace App\Console\Commands;

use App\Actions\Transactions\ConfirmDeposit;
use App\Helpers\PagStarApi;
use App\Models\Transaction;
use Illuminate\Console\Command;

class UpdatePagStarPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_pagstar_payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = date("Y-m-d");
        $pendingTransactions = Transaction::incompleDeposits()->whereDate("created_at", $date)->get();
        $this->info("Transactions Found: " . count($pendingTransactions) . " Date: " . $date);
        foreach ($pendingTransactions as $transaction) {
            $this->info("Processing transaction: " . $transaction['id']);
            $externalReference = $transaction['external_reference'];
            $pagStartApi = new PagStarApi();
            $isPaid = $pagStartApi->isPaid($externalReference);
            if (isset($transaction['id']) && $isPaid) {
                $this->info("Transaction ".$transaction['id']." Is paid");
                $confirmDeposit = new ConfirmDeposit();
                $confirmDeposit->action($transaction['id']);
            }
            $this->info("Processed: " . $transaction['id']);

        }
        $this->info("All transactions has been processed");

        return Command::SUCCESS;
    }
}
