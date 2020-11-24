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

        $domain = parse_url(url()->current(), PHP_URL_HOST);
        $providerConfig['redirect'] = sprintf('https://%s/auth/callback', $domain);

        // Push our config onto `services.google` for Socialite.
        config([
            'services.google' => $providerConfig,
        ]);

        return $providerConfig;
    }
}
