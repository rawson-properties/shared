<?php

namespace Rawson\Shared\Libs\Traits;

trait GeneratesCacheKeys
{
    public static function key(array $paramsSafe = [], array $paramsUnsafe = [])
    {
        return implode('::', array_merge(
            array_merge([ static::class ], $paramsSafe),
            array_map('md5', $paramsUnsafe)
        ));
    }
}
