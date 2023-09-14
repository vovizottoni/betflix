<?php

namespace App\PaymentGateways\libs;

use App\Enums\PaymentGatewaysEnum;
use App\PaymentGateways\traits\PaymentGatewayTrait;

class PagStarApi
{
    private $baseUrl = "https://api.pagstar.com/api/v2/";
    private $token;
    use PaymentGatewayTrait;

    function getAuthToken()
    {
        if (is_null($this->token)) {
            $this->token = env("PAGSTAR_ACCESS_TOKEN");
            return $this->token;
        } else {
            return $this->token;
        }

    }

    private function request($endpoint, array $data, $type = 'POST', $headers = [])
    {
        $data = $data + [
                'callback' => env('APP_URL'),
                'tenant_id' => env('PAGSTAR_TENANT_ID'),
            ];
        return $this->processRequest($endpoint, $data, $type, $headers);
    }

    private function requestWithToken($endpoint, array $data, $type = 'POST', $headers = [])
    {
        $headers['Authorization'] = "Bearer " . $this->getAuthToken();
        return $this->request($endpoint, $data, $type, $headers);
    }

    function isPaid($externalReference): bool
    {
        $endpoint = "wallet/partner/transactions/$externalReference/check";
        $response = $this->request($endpoint, [], 'GET', []);
        $responseInstance = $response['response_instance'];
        if ($responseInstance->status() == 200) {
            return true;
        }
        return false;
    }

    public function newDeposit($transactionId, $value, $name, $document)
    {
        $endpoint = "wallet/partner/transactions/generate-anonymous-pix";
        $data = [
            'value' => $value,
            'name' => $name,
            'document' => $document,
            'transaction_id' => $transactionId
        ];
        return $this->request($endpoint, $data, 'POST');
    }


    public function requestWithdrawal($pixKey, $doc, $value, $transactionId)
    {

        $endpoint = "wallet/partner/withdrawals/solicit-for-customer";
        $data = [
            'pix_key' => $pixKey,
            'customer_document' => getOnlyNumbers($doc),
            'value' => $value,
            'transaction_id' => $transactionId
        ];
        $data = $this->requestWithToken($endpoint, $data);
        if ($data['httpCode'] == 200) {
            return ['status' => true, 'ref' => $transactionId];
        } else {
            return ['status' => false];
        }
    }

    public function updateNotificationUrl()
    {
        $endpoint = "identity/partner/notification-url";
        $gateway = PaymentGatewaysEnum::PagStar;
        $data = [
            'notification_url' => "https://brazabet.net/webhooks/pix/" . $gateway . "/4ksAEBs0DDqtEsquBAk7CwlOUrCIqggL"
        ];
        return $this->requestWithToken($endpoint, $data, 'PATCH');
    }


}
