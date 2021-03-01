<?php

namespace Rawson\Shared\Models\Traits;

use Cache;
use Carbon\CarbonInterval;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;

trait FindOrFailCached
{
    use GeneratesCacheKeys;

    public static function findOrFailCached(int $id, CarbonInterval $interval = null): ?self
    {
        $key = self::key([ __FUNCTION__, $id, ]);
        $interval = $interval ?: CarbonInterval::day();

        return Cache::remember($key, $interval, function () use ($id) {
            return self::findOrFail($id);
        });
    }

    public static function findCached(int $id, CarbonInterval $interval = null): ?self
    {
        $key = self::key([ __FUNCTION__, $id, ]);
        $interval = $interval ?: CarbonInterval::day();

        return Cache::remember($key, $interval, function () use ($id) {
            return self::find($id);
        });
    }
}
