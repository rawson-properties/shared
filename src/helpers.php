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
        // This regex matches the first 6 digits of the id_number with yymmdd format, and stores yy, mm, dd in $dateParts,
        // bypassing all non-standard date formats that would error when converting to Carbon date
        if (strlen($input) == 13 && preg_match('/^([0-9][0-9])(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])/', $input, $dateParts)) {
            list($_, $year, $month, $day) = array_map('intval', $dateParts);
            $currentYear = Carbon::today('UTC')->year % 100;
            $year < $currentYear ? $year += 2000 : $year += 1900;
            $date = Carbon::create($year, $month, $day, 0, 0, 0, 'UTC');
            return $date;
        } else {
            return;
        }
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
