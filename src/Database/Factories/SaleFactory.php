<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\DepositHeldBy;
use Rawson\Shared\RT3Models\Sale;
use Rawson\Shared\RT3Models\SaleStatus;
use Rawson\Shared\RT3Models\SaleOtherServicesOption;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'ID',
            'SELLERLISTID' => $this->faker->randomNumber(),
            'OFFICEID' => $this->faker->randomNumber(),
            'DEALNO' => null,
            'SALEPRICE' => $this->faker->randomFloat(2),
            'SALEDATE' => $this->faker->date('Y-m-d'),
            'EXPTRANSFERDATE' => null,
            'COMMENTS' => null,
            'GROSSCOMMVALUE' => null,
            'GROSSCOMM_VALUETYPE' => $this->faker->randomElement([ 'R', '%', ]),
            'GROSSCOMMVATINCL' => $this->faker->randomElement([ 'y', 'n', ]),
            'FRANCHISECOMM_VALUETYPE' => $this->faker->randomElement([ 'R', '%', ]),
            'FRANCHISECOMMVALUE' => null,
            'FRANCHISEFEERECEIVED' => $this->faker->randomElement([ 'y', 'n', ]),
            'BEETLEREQUIREDID' => $this->faker->randomElement([ SaleOtherServicesOption::YES, SaleOtherServicesOption::NO, ]),
            'ELECTRICALREQUIREDID' => $this->faker->randomElement([ SaleOtherServicesOption::YES, SaleOtherServicesOption::NO, ]),
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
            'UPDATED' => $this->faker->dateTime(),
            'CREATED' => $this->faker->dateTime(),
            'SALESTATUSID' => SaleStatus::DRAFT,
            'DEALNAME' => null,
            'ROYALTYFEESPAID' => $this->faker->randomElement([ 'y', 'N', ]),
            'ROYALTYFEESPAIDDATE' => null,
            'ASSISTEDSALEID' => AssistedSale::NONE,
            'REFERRALFEESPAID' => $this->faker->randomElement([ 'y', 'N', ]),
            'REFERRALFEESPAIDDATE' => null,
            'RRFINVOICED' => $this->faker->randomElement([ 'y', 'N', ]),
            'RRFINVOICEDDATE' => null,
            'LETTEROFUNDERTAKING' => $this->faker->randomElement([ 'y', 'N', ]),
            'LETTEROFUNDERTAKINGDATE' => null,
        ];
    }
}
