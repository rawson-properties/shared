<?php

namespace Rawson\Shared\Libs;

use Cache;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Exception;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;

class LightProxyV2
{
    use GeneratesCacheKeys;

    private static function prepareUrl(string $url): string
    {
        return rtrim(config('services.lightproxy-v2.url'), '/') . '/' . ltrim($url, '/');
    }

    private static function request(string $method, string $url, array $params = [], array $payload = [])
    {
        if (!config('services.lightproxy-v2')) {
            throw new Exception('No LightProxyV2 config!');
        }

        $url = self::prepareUrl($url);

        // @NOTE: This isn't safe if the url already has some params.
        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        switch ($method) {
            case 'get':
                $response = Http::withHeaders(['Ocp-Apim-Subscription-Key' => config('services.lightproxy-v2.token')])->get($url);
                break;
            case 'post':
                $response = Http::withHeaders(['Ocp-Apim-Subscription-Key' => config('services.lightproxy-v2.token')])->post($url, $payload);
                break;
            default:
                throw new Exception('Not a valid request method!');
        }

        $response->throw();
        return $response->object();
    }

    public static function get(string $url, array $params = [])
    {
        return self::request('get', $url, $params);
    }

    public static function post(string $url, array $payload = [], array $params = [])
    {
        return self::request('post', $url, $params, $payload);
    }

    public static function getCached(string $url, array $params = [], CarbonInterval $interval = null)
    {
        $interval = $interval ?: CarbonInterval::day();
        $key = self::key([], array_merge([ 'url' => $url, ], $params));
        return Cache::remember($key, $interval, function () use ($url, $params) {
            return self::get($url, $params);
        });
    }

    public static function postCached(
        string $url,
        array $payload = [],
        array $params = [],
        CarbonInterval $interval = null
    ) {
        $interval = $interval ?: CarbonInterval::day();
        $key = self::key([], array_merge([ 'url' => $url, ], $payload, $params));
        return Cache::remember($key, $interval, function () use ($url, $payload, $params) {
            return self::post($url, $payload, $params);
        });
    }
}
