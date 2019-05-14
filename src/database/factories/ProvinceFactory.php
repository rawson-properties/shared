<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Province;

$factory->define(Province::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->state,
    ];
});
