<?php

use Illuminate\Support\Collection;

if (!function_exists('collectExplode')) {
    function collectExplode(string $input, string $separator = ','): Collection
    {
        return collect(explode($separator, $input))->map(function ($item) {
            return trim($item);
        })->filter(function ($item) {
            return $item;
        });
    }
}

if (!function_exists('surl')) {
    function surl(string $path)
    {
        return rtrim(config('app.static_url'), '/') . $path;
    }
}

if (!function_exists('smix')) {
    function smix(string $path)
    {
        return rtrim(config('app.static_url'), '/') . mix($path);
    }
}
