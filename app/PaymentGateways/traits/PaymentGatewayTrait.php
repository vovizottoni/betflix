<?php

namespace App\PaymentGateways\traits;

use App\PaymentGateways\responses\PixCashoutInfoResponse;
use App\PaymentGateways\responses\PixCashoutResponse;
use App\PaymentGateways\responses\PixDepositResponse;
use App\PaymentGateways\responses\PixDepositInfoResponse;
use Illuminate\Support\Facades\Http;

trait PaymentGatewayTrait
{
    public function depositResponse($status, $qrcode_url, $qrcode_content, $ref): PixDepositResponse
    {
        return new PixDepositResponse($status, $qrcode_url, $qrcode_content, $ref);
    }

    public function cashoutResponse($status, $ref = null): PixCashoutResponse
    {
        return new PixCashoutResponse($status, $ref);
    }

    public function getDepositInfoFromRequestResponse(bool $paid, $transactionCode): PixDepositInfoResponse
    {
        return new PixDepositInfoResponse($paid, $transactionCode);

    }

    public function getCashoutInfoFromRequestResponse(?string $status, $transactionCode): PixCashoutInfoResponse
    {
        return new PixCashoutInfoResponse($status, $transactionCode);

    }

    function processRequest($endpoint, array $data, $type = 'POST', $headers = [], $istPay = false)
    {
        try {
            $type = strtoupper($type);
            $requestData = $data;
            $http = Http::withHeaders($headers);

            if ($type == 'POST') {
                $response = $http->post($this->baseUrl . $endpoint, $requestData);
            } elseif ($type == 'GET') {
                $response = $http->get($this->baseUrl . $endpoint, $requestData);
            } elseif ($type == 'PATCH') {
                $response = $http->patch($this->baseUrl . $endpoint, $requestData);
            } elseif ($type == 'PUT') {
                $response = $http->put($this->baseUrl . $endpoint, $requestData);
            } elseif ($type == 'HEAD') {
                $response = $http->head($this->baseUrl . $endpoint, $requestData);
            }
            $httpCode = $response->status();
            registerGatewayLogMessage("PagStar Type:$type Code:$httpCode Data:" . json_encode($requestData) . " Endpoint: " . $this->baseUrl . $endpoint . " Body: " . json_encode($response->body()));
            $data = $response->json();
            $data['httpCode'] = $httpCode;
            $data['response_instance'] = $response;
            return $data;
        } catch (\Exception $e) {

            throw new \Exception(formatExceptionMessage($e));
        }

    }

}
