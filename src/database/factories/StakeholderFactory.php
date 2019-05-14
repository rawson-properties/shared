<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Bank;
use Rawson\Shared\RT3Models\Stakeholder;
use Rawson\Shared\RT3Models\StakeholderStatus;
use Rawson\Shared\RT3Models\StakeholderType;

$factory->define(Stakeholder::class, function (Generator $faker) {
    return [
        'STAKEHOLDERSTATUSID' => StakeholderStatus::ACTIVE,
        'STAKEHOLDERTYPEID' => StakeholderType::FRANCHISE,
        'BANKID' => Bank::NONE,
        'NAME' => $faker->company,
        'COMPANYNO' => null,
        'VATREGNO' => null,
        'FFCNO' => null,
        'BANKACCOUNTNO' => null,
        'BANKCODE' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});
