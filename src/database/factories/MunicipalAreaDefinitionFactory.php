<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\MunicipalArea;
use Rawson\Shared\RT3Models\MunicipalAreaDefinition;
use Rawson\Shared\RT3Models\Province;
use Rawson\Shared\RT3Models\Suburb;

$factory->define(MunicipalAreaDefinition::class, function (Generator $faker) {
    return [
        'P24ID' => null,
        'PROVINCEID' => null,
        'MUNICIPALAREAID' => null,
        'SUBURBID' => null,
        'POSTALCODEID' => null,
    ];
});

$factory->state(MunicipalAreaDefinition::class, 'full', function (Generator $faker) {
    return [
        'PROVINCEID' => function () {
            return factory(Province::class)->create()->ID;
        },
        'MUNICIPALAREAID' => function () {
            return factory(MunicipalArea::class)->create()->ID;
        },
        'SUBURBID' => function () {
            return factory(Suburb::class)->create()->ID;
        },
        'POSTALCODEID' => 0,
    ];
});
