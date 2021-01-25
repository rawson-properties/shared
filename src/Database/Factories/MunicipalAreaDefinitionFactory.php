<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\MunicipalArea;
use Rawson\Shared\RT3Models\MunicipalAreaDefinition;
use Rawson\Shared\RT3Models\Province;
use Rawson\Shared\RT3Models\Suburb;

class MunicipalAreaDefinitionFactory extends Factory
{
    protected $model = MunicipalAreaDefinition::class;

    public function definition()
    {
        return [
            'P24ID' => null,
            'PROVINCEID' => null,
            'MUNICIPALAREAID' => null,
            'SUBURBID' => null,
            'POSTALCODEID' => null,
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'PROVINCEID' => function () {
                    return Province::factory()->create()->ID;
                },
                'MUNICIPALAREAID' => function () {
                    return MunicipalArea::factory()->create()->ID;
                },
                'SUBURBID' => function () {
                    return Suburb::factory()->create()->ID;
                },
                'POSTALCODEID' => 0,
            ];
        });
    }
}
