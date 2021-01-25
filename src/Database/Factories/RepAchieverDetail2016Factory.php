<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\RepAchieverDetail2016;

class RepAchieverDetail2016Factory extends Factory
{
    protected $model = RepAchieverDetail2016::class;

    public function definition()
    {
        return [
            'agentName' => null,
            'personid' => $this->faker->randomNumber(),
            'employeeid' => null,
            'agentid' => $this->faker->randomNumber(),
            'officeid' => $this->faker->randomNumber(),
            'officeName' => 'Default',
            'FFCNO' => null,
            'FFC' => $this->faker->randomElement([ 'Yes', 'No', ]),
            'currStatusDate' => $this->faker->date('Y-m-d'),
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
    }

    public function none()
    {
        return $this->state(function () {
            return [
                'currStatusId' => 0,
                'currStatus' => 'No Status',
                'comments' => 'No Status~None*',
            ];
        });
    }

    public function titanium()
    {
        return $this->state(function () {
            return [
                'currStatusId' => 7,
                'currStatus' => 'Titanium',
                'comments' => 'Titanium~Titanium*You still need EITHER (a) 220.60 units OR, (b) R4,193,273.37 in commission and 0.00 units, to achieve your next status which is Titanium Elite.',
            ];
        });
    }
}
