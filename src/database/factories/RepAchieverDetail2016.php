<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\RepAchieverDetail2016;

$factory->define(RepAchieverDetail2016::class, function (Generator $faker) {
    return [
        'agentName' => null,
        'personid' => $faker->randomNumber(),
        'employeeid' => null,
        'agentid' => $faker->randomNumber(),
        'officeid' => $faker->randomNumber(),
        'officeName' => 'Default',
        'FFCNO' => null,
        'FFC' => $faker->randomElement([ 'Yes', 'No', ]),
        'currStatusDate' => $faker->date('Y-m-d'),
        'currStatusId' => null,
        'currStatus' => null,
        'calculatedAchieverSatus' => null,
        'Proficiency' => null,
        'RAP' => null,
        'RAPPreviousYear' => null,
        'totalRAP' => null,
        'NQF4' => null,
        'comments' => null,
    ];
});

$factory->state(RepAchieverDetail2016::class, 'none', function (Generator $faker) {
    return [
        'currStatusId' => 0,
        'currStatus' => 'No Status',
        'comments' => 'No Status~None*',
    ];
});

$factory->state(RepAchieverDetail2016::class, 'titanium', function (Generator $faker) {
    return [
        'currStatusId' => 7,
        'currStatus' => 'Titanium',
        'comments' => 'Titanium~Titanium*You still need EITHER (a) 220.60 units OR, (b) R4,193,273.37 in commission and 0.00 units, to achieve your next status which is Titanium Elite.',
    ];
});
