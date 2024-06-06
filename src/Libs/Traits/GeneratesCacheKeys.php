<?php

namespace Rawson\Shared\Libs\Traits;

use Illuminate\Support\Facades\App;

trait GeneratesCacheKeys
{
    public static function key(array $paramsSafe = [], array $paramsUnsafe = []): string
    {
        $env = App::environment();
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];

        return implode('::', array_merge(
            [$env, static::class, $caller],
            $paramsSafe,
            [md5(implode('::', $paramsUnsafe))]
        ));
    }
}
