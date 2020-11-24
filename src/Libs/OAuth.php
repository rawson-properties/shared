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

        $sub = Str::of(parse_url(url()->current(), PHP_URL_HOST))->before('rawson.');
        $providerConfig['redirect'] = sprintf('https://%s%s/auth/callback', $sub, $providerConfig['domain']);

        // Push our config onto `services.google` for Socialite.
        config([
            'services.google' => $providerConfig,
        ]);

        return $providerConfig;
    }
}
