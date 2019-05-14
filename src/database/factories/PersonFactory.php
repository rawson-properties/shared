<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\JobTitle;
use Rawson\Shared\RT3Models\Person;

$factory->define(Person::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_ZA\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\en_ZA\Person($faker));

    return [
        'ID' => $faker->unique->numberBetween(1, 10000000),
        'PHYSICALADDRESSID' => null,
        'TITLEID' => JobTitle::NONE,
        'JOBTITLEID' => null,
        'LANGUAGEPREFERENCEID' => null,
        'FIRSTNAME' => $faker->firstName(),
        'CELLPHONE' => $faker->e164PhoneNumber,
        'LASTNAME' => $faker->lastName(),
        'KNOWNAS' => null,
        'EMAIL' => $faker->unique()->safeEmail,
        'FAX' => null,
        'TELHOME' => $faker->e164PhoneNumber,
        'TELOFFICE' => null,
        'DOB' => $faker->date(),
        'WEDDINGANIVERSARY' => null,
        'SPOUSENAME' => null,
        'IDNUMBER' => $faker->idNumber,
        'PASSPORTNUMBER' => null,
        'PHYSICALADDRESS' => $faker->streetAddress,
        'POSTALADDRESS' => null,
        'SHORTNAME' => null,
        'ALTERNATECONTACTDETAILS' => null,
        'TAXNUMBER' => null,
        'COMMENTS' => null,
        'MARITALSTATUSID' => null,
        'FULLNAME' => null,
        'UPDATED' => null,
        'CREATED' => null,
        'FULLNAMESANITIZED' => null,
        'CELLPHONESANITIZED' => null,
        'PHOTOURLSMALL' => null,
        'PHOTOURLLARGE' => null,
        'UUID' => null,
        'SUBSCRIBED' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});
