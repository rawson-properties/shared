<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Franchise;
use Rawson\Shared\RT3Models\FranchiseStatus;
use Rawson\Shared\RT3Models\FranchiseClassification;
use Rawson\Shared\RT3Models\Stakeholder;

class FranchiseFactory extends Factory
{
    protected $model = Franchise::class;

    public function definition()
    {
        return [
            'STAKEHOLDERID' => null,
            'FRANCHISESTATUSID' => FranchiseStatus::ACTIVE,
            'FRANCHISECLASSIFICATIONID' => FranchiseClassification::NONE,
            'NAME' => $this->faker->company,
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
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'STAKEHOLDERID' => function () {
                    return Stakeholder::factory()->create()->ID;
                },
            ];
        });
    }
}
