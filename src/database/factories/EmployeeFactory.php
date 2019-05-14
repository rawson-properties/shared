<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Employee;
use Rawson\Shared\RT3Models\EmployeeStatus;
use Rawson\Shared\RT3Models\Person;

$factory->define(Employee::class, function (Generator $faker) {
    return [
        'PERSONID' => null,
        'EMPLOYEESTATUSID' => EmployeeStatus::ACTIVE,
        'TAXRATE' => '0.00',
        'FFCNO' => null,
        'FFCSTATUS' => null,
        'BVRNO' => null,
        'BVRDATE' => null,
        'EMPLOYEEEECLASSIFICATIONID' => null,
        'PRIVYSEAL' => null,
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Employee::class, 'full', function (Generator $faker) {
    return [
        'PERSONID' => function () {
            return factory(Person::class)->create()->ID;
        },
    ];
});
