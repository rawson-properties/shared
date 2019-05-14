<?php

use Rawson\Shared\RT3Models\MunicipalAreaDefinition;
use Rawson\Shared\RT3Models\Property;
use Faker\Generator;

$factory->define(Property::class, function (Generator $faker) {
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
        'PHYSICALADDRESS' => $faker->streetAddress,
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
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Property::class, 'full', function (Generator $faker) {
    return [
        'PHYSICALADDRESSID' => function () {
            return factory(MunicipalAreaDefinition::class)->states('full')->create()->ID;
        },
    ];
});
