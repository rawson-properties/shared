<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\MunicipalArea;

class MunicipalAreaFactory extends Factory
{
    protected $model = MunicipalArea::class;

    public function definition()
    {
        return [
            'ITEM' => $this->faker->state,
        ];
    }
}
