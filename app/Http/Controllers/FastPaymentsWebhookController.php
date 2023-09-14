<?php

namespace App\Http\Controllers;

use App\Actions\Transactions\ConfirmDeposit;
use App\Enums\TransactionStatus;
use App\Events\ConfirmedDeposit;
use App\Helpers\PagStarApi;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FastPaymentsWebhookController extends Controller
{
    public function index(Request $request)
    {
        $requestData = getRequestData($request);

        registerGatewayLogMessage("WebhooK: " . json_encode($requestData));

        if (isset($requestData['order_id'])) {
            $externalReference = $requestData['order_id'];
            //deposit
            $transaction = Transaction::whereExternalReference($externalReference)->incompleDeposits()->first();
            if (isset($transaction['id'])) {
                if (isset($transaction['id']) && $requestData['status'] == 'confirmed') {
                    $confirmDeposit = new ConfirmDeposit();
                    $confirmDeposit->action($transaction['id']);
                }
            } else {
                //cashout
                $ignoredStatus = [TransactionStatus::Canceled];
                $transaction = Transaction::whereExternalReference($externalReference)->whereNotIn("status", $ignoredStatus)
                    ->isCashOut()->first();
                if (isset($transaction['id'])) {
                    if ($requestData['status'] == 'confirmed' && $transaction->status != TransactionStatus::Drawee) {
                        $transaction->status = TransactionStatus::Drawee;
                        $transaction->save();
                    } elseif ($requestData['status'] == 'canceled' && $transaction->status != TransactionStatus::Canceled) {
                        $transaction->cancell();
                    }
                }
            }
        }
    }


}
