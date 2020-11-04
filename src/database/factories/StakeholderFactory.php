<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Bank;
use Rawson\Shared\RT3Models\Stakeholder;
use Rawson\Shared\RT3Models\StakeholderStatus;
use Rawson\Shared\RT3Models\StakeholderType;

class StakeholderFactory extends Factory
{
    protected $model = Stakeholder::class;

    public function definition()
    {
        return [
            'STAKEHOLDERSTATUSID' => StakeholderStatus::ACTIVE,
            'STAKEHOLDERTYPEID' => StakeholderType::FRANCHISE,
            'BANKID' => Bank::NONE,
            'NAME' => $this->faker->company,
            'COMPANYNO' => null,
            'VATREGNO' => null,
            'FFCNO' => null,
            'BANKACCOUNTNO' => null,
            'BANKCODE' => null,
            'CREATED' => $this->faker->dateTime(),
            'UPDATED' => $this->faker->dateTime(),
        ];
    }
}
