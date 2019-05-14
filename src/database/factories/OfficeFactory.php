<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Franchise;
use Rawson\Shared\RT3Models\Office;
use Rawson\Shared\RT3Models\OfficeStatus;

$factory->define(Office::class, function (Generator $faker) {
    return [
        'OFFICESTATUSID' => OfficeStatus::ACTIVE,
        'PHYSICALADDRESSID' => 1,
        'FRANCHISEID' => null,
        'NAME' => $faker->company,
        'SPEEDDIAL' => null,
        'TEL' => $faker->e164PhoneNumber,
        'TELEPHONESANITIZED' => null,
        'FAX' => null,
        'EMAIL' => null,
        'PHYSICALADDRESS' => null,
        'POSTALADDRESS' => null,
        'UNITNAME' => null,
        'STREETNUMBER' => null,
        'STREETNAME' => '',
        'GEOLATITUDE' => $faker->latitude(),
        'GEOLONGITUDE' => $faker->longitude(),
        'COMMENTS' => null,
        'TWITTERACCOUNT' => null,
        'GOOGLEACCOUNT' => null,
        'FACEBOOKACCOUNT' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Office::class, 'full', function (Generator $faker) {
    return [
        'FRANCHISEID' => function () {
            return factory(Franchise::class)->states('full')->create()->ID;
        },
    ];
});
