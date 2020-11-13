<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\BusinessType;
use Rawson\Shared\RT3Models\MandateType;
use Rawson\Shared\RT3Models\Office;
use Rawson\Shared\RT3Models\Property;
use Rawson\Shared\RT3Models\SellerList;
use Rawson\Shared\RT3Models\SellerListStatus;

class SellerListFactory extends Factory
{
    protected $model = SellerList::class;

    public function definition()
    {
        return [
            'BUSINESSTYPEID' => BusinessType::NONE,
            'SELLERLISTSTATUSID' => SellerListStatus::VALUATION,
            'MANDATETYPEID' => MandateType::SOLE,
            'PROPERTYID' => null,
            'OFFICEID' => null,
            'LISTDATE' => null,
            'LISTCODE' => null,
            'EXPIRYDATE' => null,
            'LISTPRICE' => $this->faker->randomFloat(3),
            'SELLINGREASON' => null,
            'BONDINSTITUTIONID' => 1,
            'BONDAMOUNT' => null,
            'COMMENTS' => null,
            'OFFERSFROM' => null,
            'OCCUPATIONDATERENTAL' => null,
            'OCCUPATIONDATE' => null,
            'OTHERINFO' => null,
            'SHORTADDRESS' => null,
            'FURNISHED' => null,
            'NHBRC' => null,
            'LISTINGWEBID' => 0,
            'FNBID' => 0,
            'P24ID' => 0,
            'PGENIEID' => 0,
            'RAWSONCOZAID' => 0,
            'IOLID' => 0,
            'PJUNCTIONID' => 0,
            'ASSISTEDLISTINGID' => 0,
            'ARCHIVEIMMEDIATELY' => 'n',
            'PRICERATE' => 'l',
            'CURRENCYID' => 1,
            'SYSTEMEXPIRYDATE' => '0000-00-00 00:00:00',
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'PROPERTYID' => function () {
                    return Property::factory()->full()->create()->ID;
                },
                'OFFICEID' => function () {
                    return Office::factory()->full()->create()->ID;
                },
            ];
        });
    }
}
