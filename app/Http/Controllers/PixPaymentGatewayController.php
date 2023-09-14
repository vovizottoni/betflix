<?php

namespace App\Http\Controllers;

use App\Enums\PaymentGatewaysEnum;
use App\Models\Transaction;
use App\PaymentGateways\PixPaymentGateway;
use Illuminate\Http\Request;

class PixPaymentGatewayController extends Controller
{
    public function webhook($gatewayName, Request $request)
    {
        $allGateways = PaymentGatewaysEnum::getValues();
        if (!in_array($gatewayName, $allGateways)) {
            abort(404);
        }
        $requestData = getRequestData($request);
        $gateway = new PixPaymentGateway($gatewayName);
        $externalReference = $gateway->getReferenceFromRequest($requestData);
        $transaction = Transaction::whereExternalReference($externalReference)->first();

        if (!isset($transaction['id'])) {
            abort(404);
        }
        if($gatewayName == PaymentGatewaysEnum::IstPay){
            if ($request['typeTransaction'] == 'PIX_CASHOUT') {
                $gateway->proccessCashoutWebhook($requestData);
            } else if($request['typeTransaction'] == 'PIX') {
                $gateway->proccessDepositWebhook($requestData);
            }else {
                abort(404);
            }

        }else{

            if ($transaction->isCashOut()) {
                $gateway->proccessCashoutWebhook($requestData);
            } elseif ($transaction->isDeposit()) {
                $gateway->proccessDepositWebhook($requestData);
            } else {
                abort(404);
            }

        }
        
        //dd($transaction->isDeposit(), $transaction->isCashOut(), $requestData, $gateway, $externalReference, $transaction);
    }
}
