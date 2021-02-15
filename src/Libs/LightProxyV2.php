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

    public static function get(string $url, array $params = [])
    {
        if (!config('services.lightproxy-v2')) {
            throw new Exception('No LightProxyV2 config!');
        }

        $url = self::prepareUrl($url);

        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        $response = Http::withToken(config('services.lightproxy-v2.token'))->get($url);
        $response->throw();

        return $response->object();
    }

    public static function getCached(string $url, array $params = [], CarbonInterval $interval = null)
    {
        $interval = $interval ?: CarbonInterval::day();
        $key = self::key([ __FUNCTION__, ], array_merge([ 'url' => $url, ], $params));
        return Cache::remember($key, $interval, function () use ($url, $params) {
            return self::get($url, $params);
        });
    }
}
