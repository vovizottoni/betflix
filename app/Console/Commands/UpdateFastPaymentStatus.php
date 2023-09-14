<?php

namespace App\Console\Commands;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\PaymentGateways\libs\FastPaymentsApi;
use Illuminate\Console\Command;

class UpdateFastPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_fastpayment_status';

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

        $date = time() - 3600;
        $simpleDate = date("Y-m-d", $date);
        $simpleHour = date("H:i:s", $date);
        $cashouts = Transaction::isCashout()->where("extra_data->gateway", "fast_payments")->
        whereDate("created_at", $simpleDate)->whereTime("created_at", ">=", $simpleHour)->isPixPendingCashout()->get();
        foreach ($cashouts as $cashout) {
            $fastPayment = new FastPaymentsApi();
            $transactionCode = $cashout->transaction_code;
            $data = $fastPayment->withdrawInfo($transactionCode);
            if (isset($data['status'])) {
                $status = $data['status'];
                if ($status == 'confirmed') {
                    $cashout->status = TransactionStatus::Drawee;
                    $cashout->save();
                } elseif ($status == 'canceled') {
                    $cashout->cancell();
                }
            }
        }
        return Command::SUCCESS;
    }
}
