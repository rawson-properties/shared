<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\RepSalesDetail;

class RepSalesDetailFactory extends Factory
{
    protected $model = RepSalesDetail::class;

    public function definition()
    {
        return [
            'saleid' => $this->faker->randomNumber(),
            'agent' => null,
            'agent_id' => $this->faker->randomNumber(),
            'employeeid' => null,
            'agentlistid' => null,
            'agentsaleslistid' => null,
            'officeid' => $this->faker->randomNumber(),
            'officename' => null,
            'franchiseid' => null,
            'officestatusid' => null,
            'address' => null,
            'dealno' => null,
            'saleprice' => null,
            'saledate' => null,
            'exptransferdate' => null,
            'statusdate' => null,
            'statusid' => null,
            'status' => null,
            'sale_gross_fees' => null,
            'perc_of_sp' => null,
            'franchise_fees' => null,
            'franchise_fees_perc' => null,
            'total_franchise_fees' => null,
            'office_gross_fees' => null,
            'comm_split_perc' => null,
            'branch_comm' => null,
            'branch_comm_calc_rand' => null,
            'agent_share' => null,
            'branch_share' => null,
            'agent_share_perc' => null,
            'partner_split_perc' => null,
            'deductfranchisefee' => null,
            'agentlisttypeid' => null,
            'agent_type' => null,
            'int_ext_fees' => null,
            'net_fees' => null,
            'external_fees' => null,
            'lead_fees' => null,
            'referral_office_fees' => null,
            'referring_officeid' => null,
            'referral_franchise_fees' => null,
            'grossvaluetype' => null,
            'grosscommvalue' => null,
            'gross_comm_value_calc_perc' => null,
            'agentvaluetype' => null,
            'agentcommvalue' => null,
            'employeestatusid' => null,
            'active' => null,
            'sale_updated' => $this->faker->dateTime(),
            'REFERRALFEESPAID' => $this->faker->randomElement([ 'y', 'N', ]),
            'REFERRALFEESPAIDDATE' => null,
            'sellerlistid' => null,
            'achieverunits' => null,
        ];
    }
}
