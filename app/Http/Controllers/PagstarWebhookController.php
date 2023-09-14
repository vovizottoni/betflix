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

class PagstarWebhookController extends Controller
{
    public function index(Request $request)
    {
        $requestData = getRequestData($request);

        registerGatewayLogMessage("WebhooK: " . json_encode($requestData));

        //Deposit
        if (isset($requestData['transaction_id']) && isset($requestData['type']) && $requestData['type'] == 'pay') {
            $externalReference = $requestData['transaction_id'];
            $transaction = Transaction::whereExternalReference($externalReference)->incompleDeposits()->first();
            $pagStartApi = new PagStarApi();
            if (inTestingEnvironment()) {
                $isPaid = true;
            } else {
                $isPaid = $pagStartApi->isPaid($externalReference);
            }
            if (isset($transaction['id']) && $isPaid) {
                $confirmDeposit = new ConfirmDeposit();
                $confirmDeposit->action($transaction['id']);
            } else {
                abort(404);
            }
        } 
        // Cashout
        elseif (isset($requestData['transaction_id']) && isset($requestData['type']) && $requestData['type'] == 'transfer') {
            $code = $requestData['transaction_id'];
            $ignoredStatus = [TransactionStatus::Canceled];
            $transaction = Transaction::where("transaction_code", $code)->whereNotIn("status", $ignoredStatus)
                ->isCashOut()->first();
            if (isset($transaction['id'])) {
                $pagStartApi = new PagStarApi();
                $isPaid = $pagStartApi->isPaid($code);
                if (!$isPaid) {
                    $transaction->cancell();
                } elseif ($isPaid) {
                    $transaction->status = TransactionStatus::Drawee;
                    $transaction->external_reference = $requestData['end2end'];
                    $transaction->save();
                }
            } else {
                abort(404);
            }
        }
    }


}
