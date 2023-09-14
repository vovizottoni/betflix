<?php

namespace App\PaymentGateways\libs;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class FastPaymentsApi
{
    private $baseUrl = "https://4o6eknvtc7.execute-api.us-east-2.amazonaws.com/FastPayments-API/";
    private $token;

    public function __construct()
    {
        $this->token = env("FASTPAY_TOKEN");
    }

    public function request($endpoint, array $data, $type = 'POST')
    {
        $headers = ['Token' => $this->token];
        $http = Http::withHeaders($headers);
        if ($type == 'POST') {
            $response = $http->post($this->baseUrl . $endpoint, $data);
        } else {
            $response = $http->get($this->baseUrl . $endpoint, $data);
        }
        $httpCode = $response->status();
        registerGatewayLogMessage("FastPayment Type:$type Code:$httpCode Data:" . json_encode($data) . " Endpoint: " . $this->baseUrl . $endpoint . " Body: " . json_encode($response->body()));

        $data = $response->json();
        $data['httpCode'] = $httpCode;
        $data['response_instance'] = $response;
        return $data;

    }

    public function withdrawInfo($transactionId)
    {
        $requestData = ['order_id' => $transactionId];
        return $this->request('withdraw', $requestData, 'GET');

    }

    public function newDeposit($value, $name, $document, $userId)
    {
        $data = [
            'method' => 'pix',
            'order_id' => getUniqueCode(),
            'user_id' => $userId,
            'user_name' => $name,
            'user_document' => $document,
            'amount' => $value
        ];
        $response = $this->request('deposit', $data);
        if (isset($response['link_qr'])) {
            $response['external_reference'] = $data['order_id'];
        }
        return $response;
    }

    public function requestWithdrawal($transactionId)
    {
        $transaction = Transaction::where("transaction_code", $transactionId)->isCashout()->firstOrFail();
        $extraData = $transaction->getExtraDataAsArray();
        $name = decrypt($extraData['name']);
        $doc = decrypt($extraData['document']);
        $pixKey = decrypt($extraData['pix_key']);
        $value = decrypt($extraData['amount']);
        $transaction = $transaction->account()->first();
        $user = $transaction->user()->first();
        $requestData = [
            'method' => 'pix',
            'order_id' => $transactionId,
            'user_id' => $user->id,
            'user_name' => $name,
            'user_document' => $doc,
            'pix_key' => $pixKey,
            'type_pixkey' => getPixTypeOrFails($pixKey),
            'amount' => $value
        ];
        $response = $this->request('withdraw', $requestData);
        if (isset($response['status'])) {
            $response['transaction_id'] = $transactionId;
            return $response;
        } else {
            return $response;
        }


    }

    public function checkDepositPaymentStatus($transactionId): bool
    {
        $depositInfo = $this->request('deposit', ['order_id' => $transactionId], 'GET');
        if (isset($depositInfo['orders'][0])) {
            $deposit = $depositInfo['orders'][0];
            if ($deposit['status'] == 'confirmed') {
                return true;
            }
        }
        return false;
    }
}
