<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\MunicipalArea;

$factory->define(MunicipalArea::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->state,
    ];
});
