<?php

namespace App\PaymentGateways\libs;

use App\Enums\PaymentGatewaysEnum;
use App\PaymentGateways\traits\PaymentGatewayTrait;
use Illuminate\Support\Facades\Log;

class IstPayApi
{
    private $baseUrl = "https://ws.istpay.com.br/api/v1/";
    private $token;
    use PaymentGatewayTrait;


    private function request($endpoint, array $data, $type = 'POST', $headers = [])
    {
        return $this->processRequest($endpoint, $data, $type, $headers, true);
    }

    private function requestWithToken($endpoint, array $data, $type = 'POST', $headers = [])
    {
        $headers['ci'] = env('ISTPAY_CLIENT_ID');
        $headers['cs'] = env('ISTPAY_CLIENT_SECRET');
        return $this->request($endpoint, $data, $type, $headers);
    }

    function isPaid($externalReference): bool
    {
        // $endpoint = "wallet/partner/transactions/$externalReference/check";
        // $response = $this->request($endpoint, [], 'GET', []);
        // $responseInstance = $response['response_instance'];
        // if ($responseInstance->status() == 200) {
        //     return true;
        // }
        // IstPay não possui verificação de pagamento
        return true;
    }

    public function newDeposit($transactionId, $value, $name, $document)
    {
        $endpoint = "pix/request-payment-code";
        $data = [
            'value' => $value,
            'username' => env('ISTPAY_USERNAME'),
            'document' => $document,
            'transaction_id' => $transactionId,
            'order_id' => $transactionId,
            'products' => [
                [
                    'description' => 'Deposito',
                    'quantity' => 1,
                    'value' => $value
                ]
            ],
            "client" => [
                "street" => "Av. Pedro Paulo de Souza",
                "number" => "1",
                "complement" => "Ap 1",
                "zipCode" => "74663-520",
                "neighborhood" => "Goiânia 2",
                "name" => "Paulo da Silva",
                "socialNumber" => $document,
                "phoneNumber" => "62999819999",
                "email" => "teste@istpay.com",
                "city" => "Goiânia",
                "state" => "GO"
            ]
        ];
        return $this->requestWithToken($endpoint, $data, 'POST');
    }


    public function requestWithdrawal($pixKey, $doc, $value, $transactionId)
    {

        $endpoint = "gateway/pix-payment";
        $data = [
            'typeKey' => 'document',
            'key' => getOnlyNumbers($doc),
            'value' => $value,
            'transaction_id' => $transactionId
        ];
        $data = $this->requestWithToken($endpoint, $data);
        Log::info($data);
        if ($data['httpCode'] == 200) {
            return ['status' => true, 'ref' => $data['idTransaction']];
        } else {
            return ['status' => false];
        }
    }

    public function updateNotificationUrl()
    {
        $endpoint = "identity/partner/notification-url";
        $gateway = PaymentGatewaysEnum::IstPay;
        $data = [
            'notification_url' => "https://brazabet.net/webhooks/pix/" . $gateway . "/4ksAEBs0DDqtEsquBAk7CwlOUrCIqggL"
        ];
        return $this->requestWithToken($endpoint, $data, 'PATCH');
    }
}
