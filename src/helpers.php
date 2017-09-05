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
