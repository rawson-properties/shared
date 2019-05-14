<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Suburb;

$factory->define(Suburb::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->unique()->state,
    ];
});
