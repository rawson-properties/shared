<?php

namespace Rawson\Shared\Libs;

class Img
{
    public static function url(string $path, array $params = []): string
    {
        $query = http_build_query(array_merge($params, [
            's' => self::makeSig($path, $params),
        ]));

        return sprintf('%s/%s?%s', config('img.url'), $path, $query);
    }

    private static function makeSig(string $path, array $params = []): string
    {
        unset($params['s']);
        ksort($params);

        return md5(sprintf(
            '%s:%s?%s',
            config('img.key'),
            ltrim($path, '/'),
            http_build_query($params),
        ));
    }
}
