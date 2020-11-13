<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Suburb;

class SuburbFactory extends Factory
{
    protected $model = Suburb::class;

    public function definition()
    {
        return [
            'ITEM' => $this->faker->unique()->state,
        ];
    }
}
