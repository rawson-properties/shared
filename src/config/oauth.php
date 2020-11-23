<?php

return [
    'providers' => [
        // NOTES: this key *MUST* match the domain value but without full stops.
        'rawsoncoza' => [
            'enabled' => env('OAUTH_RAWSONCOZA_ENABLED', true),
            'name' => 'Rawson South Africa',
            'domain' => 'rawson.co.za',
            'client_id' => env('GOOGLE_CLIENT_ID', '295637650675-efcjub1m8lspbu7n0j81dfq9t43h3it3.apps.googleusercontent.com'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET', 'yhjuSLsL4VYrPrARMsj3o03i'),
        ],
        'rawsonmu' => [
            'enabled' => env('OAUTH_MAURITIUS_ENABLED', false),
            'name' => 'Rawson Mauritius',
            'domain' => 'rawson.mu',
            'client_id' => '278242680039-jsgs99u5nar315oku176gh6dvjmdv6s9.apps.googleusercontent.com',
            'client_secret' => 'HARvNWfpcuDDCzI2szfOzfAw',
        ],
        /*
        'rawsonpropertiescom' => [
            'enabled' => env('OAUTH_RAWSONPROPERTIES_ENABLED', false),
            'name' => 'Rawson Properties',
            'domain' => 'rawsonproperties.com',
            'client_id' => '523222699424-vlib4i13tctrhn8dausu2mi50qf147dj.apps.googleusercontent.com',
            'client_secret' => 'icy10wejnnjgkWz7Gf5JUl40',
        ],
        */
    ],
    'redirect' => config('app.url') . '/auth/callback',
    'scopes' => [],
];
