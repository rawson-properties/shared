<?php

use Carbon\Carbon;
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

if (!function_exists('sa_id_to_date')) {
    /**
     * @param string $input
     * @return mixed null|Carbon
     */
    function sa_id_to_date($input)
    {
        $chars = str_split($input);

        if (count($chars) !== 13) {
            return;
        }

        $year = (int) $chars[0] . $chars[1];
        $month = (int) $chars[2] . $chars[3];
        $day = (int) $chars[4] . $chars[5];

        $date = new Carbon;
        $date->year = $year < 20 ? 2000 + $year : 1900 + $year;
        $date->month = $month;
        $date->day = $day;

        return $date;
    }
}

if (!function_exists('extract_xml_tags')) {
    /**
     * @param string $xml
     * @param string $tag
     * @return array
     */
    function extract_xml_tags($xml, $tag)
    {
        $tag = strtolower($tag);
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $values, $index);
        xml_parser_free($p);
        $items = [];
        $open = false;
        foreach ($values as $index => $value) {
            if (strtolower(array_get($value, 'tag')) === $tag && array_get($value, 'type') === 'open') {
                $open = true;
                $item = [];
            }

            if (strtolower(array_get($value, 'tag')) === $tag && array_get($value, 'type') === 'close') {
                $open = false;
                $items[] = $item;
            }

            if ($open === true && array_get($value, 'type') === 'complete') {
                $k = strtolower(array_get($value, 'tag'));
                $v = trim(array_get($value, 'value'));
                $item[$k] = $v;
            }
        }

        return $items;
    }
}
