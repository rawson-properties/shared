<?php

namespace Rawson\Shared\Libs;

use Exception;

class OAuth
{
    public static function getSetConfig(string $providerKey): array
    {
        $providerConfig = config('oauth.providers.' . $providerKey);
        if ($providerConfig == null) {
            throw new Exception('Invalid provider name!');
        }

        $providerConfig['redirect'] = config('oauth.redirect');

        // Push our config onto `services.google` for Socialite.
        config([
            'services.google' => $providerConfig,
            'oauth.redirect' => request()->getHost() . '/auth/callback',
        ]);

        return $providerConfig;
    }
}
