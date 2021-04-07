<?php

namespace Rawson\Shared\Libs;

use Exception;
use Illuminate\Support\Str;

class OAuth
{
    public static function getSetConfig(string $providerKey): array
    {
        $providerConfig = config('oauth.providers.' . $providerKey);
        if ($providerConfig == null) {
            throw new Exception('Invalid provider name!');
        }

        $scheme = parse_url(url()->current(), PHP_URL_SCHEME);
        $sub = Str::of(parse_url(url()->current(), PHP_URL_HOST))->before('rawson.');

        $providerConfig['redirect'] = sprintf(
            '%s://%s%s/auth/callback',
            $scheme,
            $sub,
            $providerConfig['redirectdomain']
        );

        // Push our config onto `services.google` for Socialite.
        config([
            'services.google' => $providerConfig,
        ]);

        return $providerConfig;
    }
}
