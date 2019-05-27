<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\DepositHeldBy;
use Rawson\Shared\RT3Models\Sale;
use Rawson\Shared\RT3Models\SaleStatus;
use Rawson\Shared\RT3Models\SaleOtherServicesOption;

$factory->define(Sale::class, function (Generator $faker) {
    return [
        'ID',
        'SELLERLISTID' => $faker->randomNumber(),
        'OFFICEID' => $faker->randomNumber(),
        'DEALNO' => null,
        'SALEPRICE' => $faker->randomFloat(2),
        'SALEDATE' => $faker->date('Y-m-d'),
        'EXPTRANSFERDATE' => null,
        'COMMENTS' => null,
        'GROSSCOMMVALUE' => null,
        'GROSSCOMM_VALUETYPE' => $faker->randomElement([ 'R', '%', ]),
        'GROSSCOMMVATINCL' => $faker->randomElement([ 'y', 'n', ]),
        'FRANCHISECOMM_VALUETYPE' => $faker->randomElement([ 'R', '%', ]),
        'FRANCHISECOMMVALUE' => null,
        'FRANCHISEFEERECEIVED' => $faker->randomElement([ 'y', 'n', ]),
        'BEETLEREQUIREDID' => $faker->randomElement([ SaleOtherServicesOption::YES, SaleOtherServicesOption::NO, ]),
        'ELECTRICALREQUIREDID' => $faker->randomElement([ SaleOtherServicesOption::YES, SaleOtherServicesOption::NO, ]),
        'BONDEXPIRY' => null,
        'BONDAMOUNTREQ' => null,
        'RT2SALEATTORNEY' => null,
        'RT2BONDATTORNEY' => null,
        'RT2BEETLE' => null,
        'RT2ELECTRICAL' => null,
        'DEPOSITHELDBYID' => DepositHeldBy::NONE,
        'DEPOSITAMOUNT' => null,
        'DEPOSITDUEDATE' => null,
        'DEPOSITPAIDDATE' => null,
        'UPDATED' => $faker->dateTime(),
        'CREATED' => $faker->dateTime(),
        'SALESTATUSID' => SaleStatus::DRAFT,
        'DEALNAME' => null,
        'ROYALTYFEESPAID' => $faker->randomElement([ 'y', 'N', ]),
        'ROYALTYFEESPAIDDATE' => null,
        'ASSISTEDSALEID' => AssistedSale::NONE,
        'REFERRALFEESPAID' => $faker->randomElement([ 'y', 'N', ]),
        'REFERRALFEESPAIDDATE' => null,
        'RRFINVOICED' => $faker->randomElement([ 'y', 'N', ]),
        'RRFINVOICEDDATE' => null,
        'LETTEROFUNDERTAKING' => $faker->randomElement([ 'y', 'N', ]),
        'LETTEROFUNDERTAKINGDATE' => null,
    ];
});
