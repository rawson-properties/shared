<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\MunicipalAreaDefinition;
use Rawson\Shared\RT3Models\Property;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'AGENTLISTID' => null,
            'OFFICEID' => null,
            'PROPERTYTYPEID' => 0,
            'MEASUREMENTSID' => 0,
            'RATESPERIODID' => 0,
            'ERFNO' => null,
            'SECTIONALTITLENO' => null,
            'ERFSIZE' => null,
            'BUILDINGSIZE' => null,
            'RATESAMT' => null,
            'SECTIONALTITLELEVY' => null,
            'HOMEOWNERLEVY' => null,
            'NUMBEDROOMS' => null,
            'NUMBATHROOMS' => null,
            'NUMRECEPTIONROOMS' => null,
            'NUMSTUDIES' => null,
            'NUMFAMILYROOMS' => null,
            'NUMSTOREROOMS' => null,
            'NUMFIREPLACES' => null,
            'NUMGARAGES' => null,
            'NUMCARPORTS' => null,
            'NUMPARKING' => null,
            'NUMFLATLETS' => null,
            'PROPERTYTITLETYPEID' => 0,
            'PHYSICALADDRESSID' => null,
            'UNITNAME' => null,
            'UNITNUMBER' => null,
            'STREETNUMBER' => null,
            'PHYSICALADDRESS' => $this->faker->streetAddress,
            'propertyaddress' => null,
            'MANAGINGAGENT' => null,
            'ADDITIONALFEATURES' => null,
            'COMMENTS' => null,
            'GEOLATITUDE' => null,
            'GEOLONGITUDE' => null,
            'LIGHTSTONEID' => null,
            'NUMTVROOM' => null,
            'NUMLOUNGE' => null,
            'NUMDININGROOM' => null,
            'GEOLOCATIONOPTION' => null,
            'NAME' => null,
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function () {
            return [
                'PHYSICALADDRESSID' => function () {
                    return MunicipalAreaDefinition::factory()->full()->create()->ID;
                },
            ];
        });
    }
}
