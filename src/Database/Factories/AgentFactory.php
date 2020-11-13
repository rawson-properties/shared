<?php

namespace Rawson\Shared\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rawson\Shared\RT3Models\Agent;
use Rawson\Shared\RT3Models\Employee;
use Rawson\Shared\RT3Models\Office;

class AgentFactory extends Factory
{
    protected $model = Agent::class;

    public function definition()
    {
        return [
            'OFFICEID' => null,
            'EMPLOYEEID' => null,
            'LISTINGACCESSID' => 1,
            'LISTINGIMAGEACCESS' => 'y',
            'BUYERACCESS' => 'y',
            'COMMSPLIT' => '50.00',
            'BONDCOMMSPLIT' => '0.00',
            'LETTINGAGENT' => 'n',
            'LISTINGAGENT' => 'y',
            'ACTIVE' => 'y',
            'DEDUCTFRFEE' => 'y',
            'OFFICEADMIN' => 'n',
            'P24AGENTID' => null,
            'PgenieAgentId' => null,
            'NotifySaleSuspensive' => 'n',
            'NotifySaleFinal' => 'n',
            'NotifySaleClose' => 'n',
            'NotifySaleActivitiesExpire' => 'y',
            'RAP' => 'y',
            'NotifyRAP' => 'y',
            'NotifyReferral' => 'y',
            'DEFAULTOFFICE' => 'y',
            'SALEACCESS'=> 'y',
            'LISTINGREPORTACCESS' => 'y',
            'BUYERREPORTACCESS' => 'y',
            'RAPREPORTACCESS' => 'n',
            'SALEREPORTACCESS' => 'y',
            'REFERRALREPORTACCESS' => 'n',
            'NOTIFYWEBSMSNOTIFICATION' => 'n',
            'UPDATED' => $this->faker->dateTime(),
        ];
    }

    public function full()
    {
        return $this->state(function (array $attributes) {
            return [
                'OFFICEID' => function () {
                    return Office::factory()->full()->create()->ID;
                },
                'EMPLOYEEID' => function () {
                    return Employee::factory()->full()->create()->ID;
                },
            ];
        });
    }
}
