<?php

namespace App\Console\Commands;

use App\Actions\Transactions\ConfirmDeposit;
use App\Helpers\PagStarApi;
use App\Models\Transaction;
use Illuminate\Console\Command;

class UpdatePagStarUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_pagstar_url';

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
        $pagStartApi = new \App\PaymentGateways\libs\PagStarApi();
        var_dump($pagStartApi->updateNotificationUrl());
        return Command::SUCCESS;
    }
}
