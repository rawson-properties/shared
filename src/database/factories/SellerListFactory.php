<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\BusinessType;
use Rawson\Shared\RT3Models\MandateType;
use Rawson\Shared\RT3Models\Office;
use Rawson\Shared\RT3Models\Property;
use Rawson\Shared\RT3Models\SellerList;
use Rawson\Shared\RT3Models\SellerListStatus;

$factory->define(SellerList::class, function (Generator $faker) {
    return [
        'BUSINESSTYPEID' => BusinessType::NONE,
        'SELLERLISTSTATUSID' => SellerListStatus::VALUATION,
        'MANDATETYPEID' => MandateType::SOLE,
        'PROPERTYID' => null,
        'OFFICEID' => null,
        'LISTDATE' => null,
        'LISTCODE' => null,
        'EXPIRYDATE' => null,
        'LISTPRICE' => $faker->randomFloat(3),
        'SELLINGREASON' => null,
        'BONDINSTITUTIONID' => 1,
        'BONDAMOUNT' => null,
        'COMMENTS' => null,
        'OFFERSFROM' => null,
        'OCCUPATIONDATERENTAL' => null,
        'OCCUPATIONDATE' => null,
        'OTHERINFO' => null,
        'SHORTADDRESS' => null,
        'FURNISHED' => null,
        'NHBRC' => null,
        'LISTINGWEBID' => 0,
        'FNBID' => 0,
        'P24ID' => 0,
        'PGENIEID' => 0,
        'RAWSONCOZAID' => 0,
        'IOLID' => 0,
        'PJUNCTIONID' => 0,
        'ASSISTEDLISTINGID' => 0,
        'ARCHIVEIMMEDIATELY' => 'n',
        'PRICERATE' => 'l',
        'CURRENCYID' => 1,
        'SYSTEMEXPIRYDATE' => '0000-00-00 00:00:00',
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(SellerList::class, 'full', function (Generator $faker) {
    return [
        'PROPERTYID' => function () {
            return factory(Property::class)->states('full')->create()->ID;
        },
        'OFFICEID' => function () {
            return factory(Office::class)->states('full')->create()->ID;
        },
    ];
});
