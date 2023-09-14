<?php

namespace App\Helpers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HypeTechApi
{
    private $game;
    private $baseUrl;

    public function __construct($game)
    {
        $this->game = $game;
        $this->baseUrl = env("DOMINIO_HYPETECH");
    }

    private function request($endpoint, array $data, $type = 'POST', $headers = [])
    {
        try {
            $type = strtoupper($type);

            $headers['Authorization'] = "Bearer " . $this->game->token_hypetech;
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
            }
            $data = $response->json();
            $data['response_instance'] = $response;
            return $data;
        } catch (\Exception $e) {
            throw new \Exception("Failed to connect.");
        }

    }

    public function requestAccess($account)
    {
        $user = $account->user()->first();
        $endpoint = "/games/request-access";
        $data = [
            'user_id' => $user->id . '#' . $account->id,
            'game' => $this->game->game_code, //motorbike
            'username' => $user->name,
            'balance' => $account->balance,
            'avatar_url' => env('APP_URL') . $account->photo,
            'currency' => ((session()->get('balanceUsed') == 'balance' || session()->get('balanceUsed') == 'balanceBonus') ? 'BRL' : 'USD'),
            'lang' => 'pt'
        ];
        $data = $this->request($endpoint, $data);
        if (!isset($data['game_url'])) {
            throw new \Exception(__("cashout.msg_erro_falha_na_requisicao"));
        }
        $url = $data['game_url'];
        $tokenUArr = explode('/', $url);
        $tokenU = $tokenUArr[count($tokenUArr) - 1];
        return ['url' => $url, 'token' => $tokenU];

    }
}
