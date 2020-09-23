<?php

namespace Rawson\Shared\Libs;

use Carbon\Carbon;

class HubspotHelpers
{
    public static function formatDate(string $date): string
    {
        $date = Carbon::parse($date, 'UTC');
        $date = Carbon::create($date->year, $date->month, $date->day, 0, 0, 0, 'UTC');
        return $date->timestamp * 1000;
    }

    public static function splitName(string $name): array
    {
        $names = collect(explode(' ', $name));

        return [
            'first_name' => $names->shift(),
            'last_name' => $names->implode(' '),
        ];
    }

    public static function mergeMultiString(string $first, string $second, string $glue = ';'): string
    {
        $first = collect(explode($glue, $first));
        $second = collect(explode($glue, $second));

        $merge = $first->merge($second)->unique()->implode($glue);
        return trim($merge, $glue);
    }
}
