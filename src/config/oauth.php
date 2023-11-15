<?php

return [
    'providers' => [
        // NOTES: this key *MUST* match the domain value but without full stops.
        'rawsoncoza' => [
            'enabled' => env('OAUTH_RAWSONCOZA_ENABLED', true),
            'name' => 'Rawson South Africa',
            'domain' => 'rawson.co.za',
            'redirectdomain' => env('OAUTH_REDIRECT_DOMAIN'),
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
        ],
        'rawsonmu' => [
            'enabled' => env('OAUTH_MAURITIUS_ENABLED', false),
            'name' => 'Rawson Mauritius',
            'domain' => 'rawson.mu',
            'redirectdomain' => env('OAUTH_REDIRECT_DOMAIN_MU'),
            'client_id' => env('OAUTH_CLIENT_ID_MU'),
            'client_secret' => env('OAUTH_CLIENT_SECRET_MU'),
        ],
        'rawsonpropertiescom' => [
            'enabled' => env('OAUTH_RAWSONPROPERTIES_ENABLED', false),
            'name' => 'Rawson Properties',
            'domain' => 'rawsonproperties.com',
            'redirectdomain' => env('OAUTH_REDIRECT_DOMAIN_COM', 'rawson.co.za'),
            'client_id' => env('OAUTH_CLIENT_ID_COM'),
            'client_secret' => env('OAUTH_CLIENT_SECRET_COM'),
        ],
    ],
    'scopes' => [],
];
