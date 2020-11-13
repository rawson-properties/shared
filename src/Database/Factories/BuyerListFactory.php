<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\BuyerList;
use Rawson\Shared\RT3Models\BuyerListStatus;
use Rawson\Shared\RT3Models\Office;

class BuyerListFactory extends Factory
{
    protected $model = BuyerList::class;

    public function definition()
    {
        return [
            'BUYERLISTSTATUSID' => BuyerListStatus::DRAFT,
            'ADVERTISINGSOURCEID' => null,
            'OFFICEID' => null,
            'MINPRICE' => 0.000,
            'MAXPRICE' => 0.000,
            'NUMBEDROOMS' => 0,
            'NUMBATHROOMS' => 0,
            'NUMGARAGES' => 0,
            'NUMCARPORTS' => 0,
            'REQUIREMENTS' => null,
            'INTRODUCTIONDATE' => null,
            'BUYERSOURCEOTHER' => null,
            'EXPIRYDATE' => null,
            'COMMENTS' => null,
            'REFERENCE' => null,
            'REFMETHODCREATED' => 'n',
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'OFFICEID' => function () {
                    return Office::factory()->full()->create()->ID;
                },
            ];
        });
    }
}
