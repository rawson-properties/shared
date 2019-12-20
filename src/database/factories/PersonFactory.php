<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\JobTitle;
use Rawson\Shared\RT3Models\Person;

$factory->define(Person::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_ZA\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\en_ZA\Person($faker));

    $firstName = $faker->firstName();
    $lastName = $faker->lastName();

    return [
        'ID' => $faker->unique->numberBetween(1, 10000000),
        'PHYSICALADDRESSID' => null,
        'TITLEID' => JobTitle::NONE,
        'JOBTITLEID' => null,
        'LANGUAGEPREFERENCEID' => null,
        'FIRSTNAME' => $firstName,
        'CELLPHONE' => $faker->e164PhoneNumber,
        'LASTNAME' => $lastName,
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
        'FULLNAME' => sprintf('%s %s', $firstName, $lastName),
        'UPDATED' => null,
        'CREATED' => null,
        'FULLNAMESANITIZED' => sprintf('%s %s', $firstName, $lastName),
        'CELLPHONESANITIZED' => $faker->e164PhoneNumber,
        'PHOTOURLSMALL' => null,
        'PHOTOURLLARGE' => null,
        'UUID' => null,
        'SUBSCRIBED' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});
