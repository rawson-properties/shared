<?php

return [
    'providers' => [
        // NOTES: this key *MUST* match the domain value but without full stops.
        'rawsoncoza' => [
            'name' => 'Rawson South Africa',
            'domain' => 'rawson.co.za',
            'client_id' => env('GOOGLE_CLIENT_ID', '295637650675-efcjub1m8lspbu7n0j81dfq9t43h3it3.apps.googleusercontent.com'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET', 'yhjuSLsL4VYrPrARMsj3o03i'),
        ],
        'rawsonmauritius' => [
            'name' => 'Rawson Mauritius',
            'domain' => 'rawson.my',
            'client_id' => '@TODO',
            'client_secret' => '@TODO',
        ],
        /*
        'rawsonpropertiescom' => [
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
