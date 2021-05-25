<?php

namespace Rawson\Shared\Libs\Traits;

trait GeneratesCacheKeys
{
    public static function key(array $paramsSafe = [], array $paramsUnsafe = [])
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];

        return implode('::', array_merge(
            array_merge([ static::class, $caller, ], $paramsSafe),
            array_map('md5', $paramsUnsafe)
        ));
    }
}
