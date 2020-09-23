<?php

namespace Rawson\Shared\Libs;

use Exception;

class OAuth
{
    public static function getSetConfig(string $providerName): array
    {
        $providerConfig = config('oauth.providers.' . $providerName);
        if ($providerConfig == null) {
            throw new Exception('Invalid provider name!');
        }

        $providerConfig['redirect'] = config('oauth.redirect');

        // Push our config onto `services.google` for Socialite.
        config([ 'services.google' => $providerConfig, ]);

        return $providerConfig;
    }
}
