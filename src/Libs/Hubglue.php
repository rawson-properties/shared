<?php

namespace Rawson\Shared\Libs;

use GuzzleHttp\Client as GuzzleClient;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use Cache;

class Hubglue
{
    use GeneratesCacheKeys;

    public $client;

    private static function getToken(): string
    {
        $key = self::key([
            'getToken',
        ], [
            config('services.hubglue.client_id'),
            config('services.hubglue.client_secret'),
        ]);

        return Cache::remember($key, 24 * 60, function () {
            $guzzle = new GuzzleClient();
            $response = $guzzle->post(config('services.hubglue.url') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('services.hubglue.client_id'),
                    'client_secret' => config('services.hubglue.client_secret'),
                ],
            ]);

            $json = json_decode((string) $response->getBody());
            return object_get($json, 'access_token');
        });
    }

    protected static function get(string $endpoint)
    {
        $guzzle = new GuzzleClient();
        $response = $guzzle->request(
            'GET',
            config('services.hubglue.url') . '/api/' . $endpoint,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . self::getToken(),
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 5,
            ]
        );

        return (string) $response->getBody();
    }

    private static function post(string $endpoint, array $data = [])
    {
        $guzzle = new GuzzleClient();
        $response = $guzzle->request(
            'POST',
            config('services.hubglue.url') . '/api/' . $endpoint,
            [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . self::getToken(),
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        return json_decode((string) $response->getBody());
    }

    public static function ping()
    {
        return self::get('ping');
    }

    public static function form(array $data)
    {
        return self::post('form', $data);
    }
}
