<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Employee;
use Rawson\Shared\RT3Models\EmployeeStatus;
use Rawson\Shared\RT3Models\Person;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
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
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'PERSONID' => function () {
                    return Person::factory()->create()->ID;
                },
            ];
        });
    }
}
