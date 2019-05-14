<?php

use Faker\Generator;
use Rawson\Shared\RT3Models\Agent;
use Rawson\Shared\RT3Models\Employee;
use Rawson\Shared\RT3Models\Office;

$factory->define(Agent::class, function (Generator $faker) {
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
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Agent::class, 'full', function (Generator $faker) {
    return [
        'OFFICEID' => function () {
            return factory(Office::class)->states('full')->create()->ID;
        },
        'EMPLOYEEID' => function () {
            return factory(Employee::class)->states('full')->create()->ID;
        },
    ];
});
