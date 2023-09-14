<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FunGamesApi
{
    private $game;
    private $baseUrl;

    public function __construct($game)
    {
        $this->game = $game;
        $this->baseUrl = env("FUNGAMESS_API");
    }

    private function request($endpoint, array $data)
    {
        try {
            $requestData = $data;
            $response = Http::get($this->baseUrl . $endpoint, $requestData);
            $data = $response->json();
            $data['response_instance'] = $response;
            return $data;
        } catch (\Exception $e) {
            throw new \Exception("Failed to connect.");
        }

    }

    public function getLink($userId, $tokenAccountCreated)
    {
        $endpoint = "/start";
        $dataBody = [
            'demo' => false,
            'token' => $tokenAccountCreated,
            'userId' => $userId . fungamesSufix(),
            'gameId' => $this->game->game_id,
            'lang' => 'pt',
            'country' => 'BR'
        ];
        $data = $this->request($endpoint, $dataBody)['response_instance'];
        return $data->transferStats->getEffectiveUri()->__toString();

    }
}
