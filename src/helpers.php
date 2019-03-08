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
    function sa_id_to_date($input): ?Carbon
    {
        /*
         * This regex matches the first 6 digits of the id_number with yymmdd format,
         * and stores yy, mm, dd in $dateParts, bypassing all non-standard date formats
         * that would error when converting to Carbon date
         */
        $pattern = '/^([0-9][0-9])(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])/';
        if (strlen($input) == 13 && preg_match($pattern, $input, $dateParts)) {
            list($_, $year, $month, $day) = array_map('intval', $dateParts);
            $currentYear = Carbon::today('UTC')->year % 100;
            $year += $year < $currentYear ? 2000 : 1900;

            return Carbon::create($year, $month, $day, 0, 0, 0, 'UTC');
        } else {
            return null;
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
            if (strtolower(data_get($value, 'tag')) === $tag && data_get($value, 'type') === 'open') {
                $open = true;
                $item = [];
            }

            if (strtolower(data_get($value, 'tag')) === $tag && data_get($value, 'type') === 'close') {
                $open = false;
                $items[] = $item;
            }

            if ($open === true && data_get($value, 'type') === 'complete') {
                $k = strtolower(data_get($value, 'tag'));
                $v = trim(data_get($value, 'value'));
                $item[$k] = $v;
            }
        }

        return $items;
    }
}
