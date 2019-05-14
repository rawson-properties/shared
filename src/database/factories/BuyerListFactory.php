<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\BuyerList;
use Rawson\Shared\RT3Models\BuyerListStatus;
use Rawson\Shared\RT3Models\Office;

$factory->define(BuyerList::class, function (Generator $faker) {
    return [
        'BUYERLISTSTATUSID' => BuyerListStatus::DRAFT,
        'ADVERTISINGSOURCEID' => null,
        'OFFICEID' => null,
        'MINPRICE' => 0.000,
        'MAXPRICE' => 0.000,
        'NUMBEDROOMS' => 0,
        'NUMBATHROOMS' => 0,
        'NUMGARAGES' => 0,
        'NUMCARPORTS' => 0,
        'REQUIREMENTS' => null,
        'INTRODUCTIONDATE' => null,
        'BUYERSOURCEOTHER' => null,
        'EXPIRYDATE' => null,
        'COMMENTS' => null,
        'REFERENCE' => null,
        'REFMETHODCREATED' => 'n',
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(BuyerList::class, 'full', function (Generator $faker) {
    return [
        'OFFICEID' => function () {
            return factory(Office::class)->states('full')->create()->ID;
        },
    ];
});
