<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\JobTitle;
use Rawson\Shared\RT3Models\Person;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\en_ZA\PhoneNumber($this->faker));
        $this->faker->addProvider(new \Faker\Provider\en_ZA\Person($this->faker));

        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();

        return [
            'ID' => $this->faker->unique->numberBetween(1, 10000000),
            'PHYSICALADDRESSID' => null,
            'TITLEID' => JobTitle::NONE,
            'JOBTITLEID' => null,
            'LANGUAGEPREFERENCEID' => null,
            'FIRSTNAME' => $firstName,
            'CELLPHONE' => $this->faker->e164PhoneNumber,
            'LASTNAME' => $lastName,
            'KNOWNAS' => null,
            'EMAIL' => $this->faker->unique()->safeEmail,
            'FAX' => null,
            'TELHOME' => $this->faker->e164PhoneNumber,
            'TELOFFICE' => null,
            'DOB' => $this->faker->date(),
            'WEDDINGANIVERSARY' => null,
            'SPOUSENAME' => null,
            'IDNUMBER' => $this->faker->idNumber,
            'PASSPORTNUMBER' => null,
            'PHYSICALADDRESS' => $this->faker->streetAddress,
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
            'CELLPHONESANITIZED' => $this->faker->e164PhoneNumber,
            'PHOTOURLSMALL' => null,
            'PHOTOURLLARGE' => null,
            'UUID' => null,
            'SUBSCRIBED' => null,
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }
}
