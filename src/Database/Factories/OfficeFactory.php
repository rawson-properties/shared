<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Franchise;
use Rawson\Shared\RT3Models\Office;
use Rawson\Shared\RT3Models\OfficeStatus;

class OfficeFactory extends Factory
{
    protected $model = Office::class;

    public function definition()
    {
        return [
            'OFFICESTATUSID' => OfficeStatus::ACTIVE,
            'PHYSICALADDRESSID' => 1,
            'FRANCHISEID' => null,
            'NAME' => $this->faker->company,
            'SPEEDDIAL' => null,
            'TEL' => $this->faker->e164PhoneNumber,
            'TELEPHONESANITIZED' => null,
            'FAX' => null,
            'EMAIL' => null,
            'PHYSICALADDRESS' => null,
            'POSTALADDRESS' => null,
            'UNITNAME' => null,
            'STREETNUMBER' => null,
            'STREETNAME' => '',
            'GEOLATITUDE' => $this->faker->latitude(),
            'GEOLONGITUDE' => $this->faker->longitude(),
            'COMMENTS' => null,
            'TWITTERACCOUNT' => null,
            'GOOGLEACCOUNT' => null,
            'FACEBOOKACCOUNT' => null,
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'FRANCHISEID' => function () {
                    return Franchise::factory()->full()->create()->ID;
                },
            ];
        });
    }
}
