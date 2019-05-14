<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Franchise;
use Rawson\Shared\RT3Models\FranchiseStatus;
use Rawson\Shared\RT3Models\FranchiseClassification;
use Rawson\Shared\RT3Models\Stakeholder;

$factory->define(Franchise::class, function (Generator $faker) {
    return [
        'STAKEHOLDERID' => null,
        'FRANCHISESTATUSID' => FranchiseStatus::ACTIVE,
        'FRANCHISECLASSIFICATIONID' => FranchiseClassification::NONE,
        'NAME' => $faker->company,
        'WEBPORTALNAME' => null,
        'BUSINESSNAMECOR' => null,
        'SALESTARGET' => null,
        'PERCENTGROSS' => null,
        'FRANCHISEFEEPAYABLE' => null,
        'P24FEED' => null,
        'P24OFFICEID' => null,
        'FNBQSID' => null,
        'PGENIEOFFICEID' => null,
        'PGENIEREG' => null,
        'CCMANAGERONLEADS' => null,
        'AGENTLISTID' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Franchise::class, 'full', function (Generator $faker) {
    return [
        'STAKEHOLDERID' => function () {
            return factory(Stakeholder::class)->create()->ID;
        },
    ];
});
