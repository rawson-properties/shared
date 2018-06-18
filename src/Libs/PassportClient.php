<?php

namespace Rawson\Shared\Libs;

use GuzzleHttp\Client as GuzzleClient;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use Cache;

class PassportClient
{
    use GeneratesCacheKeys;

    private $clientID;
    private $clientSecret;
    private $baseURL;

    public $client;

    public function __construct(string $baseURL, string $clientID, string $clientSecret)
    {
        $this->baseURL = $baseURL;
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
    }

    private function getToken(): string
    {
        $key = self::key([ 'getToken', ], [ $this->baseURL, $this->clientID, $this->clientSecret, ]);

        return Cache::remember($key, 24 * 60, function () {
            $guzzle = new GuzzleClient();
            $response = $guzzle->post($this->baseURL . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientID,
                    'client_secret' => $this->clientSecret,
                ],
            ]);

            $json = json_decode((string) $response->getBody());
            return object_get($json, 'access_token');
        });
    }

    public function get(string $endpoint)
    {
        $guzzle = new GuzzleClient();
        $response = $guzzle->request(
            'GET',
            $this->baseURL . $endpoint,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getToken(),
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 5,
            ]
        );

        return json_decode((string) $response->getBody());
    }

    public function post(string $endpoint, array $data = [])
    {
        $guzzle = new GuzzleClient();
        $response = $guzzle->request(
            'POST',
            $this->baseURL . $endpoint,
            [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getToken(),
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        return json_decode((string) $response->getBody());
    }
}
