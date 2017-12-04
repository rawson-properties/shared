<?php

use Rawson\Shared\RT3Models\Agent;
use Rawson\Shared\RT3Models\Bank;
use Rawson\Shared\RT3Models\BusinessType;
use Rawson\Shared\RT3Models\BuyerList;
use Rawson\Shared\RT3Models\BuyerListStatus;
use Rawson\Shared\RT3Models\Employee;
use Rawson\Shared\RT3Models\EmployeeStatus;
use Rawson\Shared\RT3Models\Franchise;
use Rawson\Shared\RT3Models\FranchiseClassification;
use Rawson\Shared\RT3Models\FranchiseStatus;
use Rawson\Shared\RT3Models\JobTitle;
use Rawson\Shared\RT3Models\MandateType;
use Rawson\Shared\RT3Models\MunicipalArea;
use Rawson\Shared\RT3Models\MunicipalAreaDefinition;
use Rawson\Shared\RT3Models\Office;
use Rawson\Shared\RT3Models\OfficeStatus;
use Rawson\Shared\RT3Models\Person;
use Rawson\Shared\RT3Models\Property;
use Rawson\Shared\RT3Models\Province;
use Rawson\Shared\RT3Models\SellerList;
use Rawson\Shared\RT3Models\SellerListStatus;
use Rawson\Shared\RT3Models\Suburb;
use Rawson\Shared\RT3Models\Stakeholder;
use Rawson\Shared\RT3Models\StakeholderStatus;
use Rawson\Shared\RT3Models\StakeholderType;
use Faker\Generator;

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

$factory->define(Employee::class, function (Generator $faker) {
    return [
        'PERSONID' => null,
        'EMPLOYEESTATUSID' => EmployeeStatus::ACTIVE,
        'TAXRATE' => '0.00',
        'FFCNO' => null,
        'FFCSTATUS' => null,
        'BVRNO' => null,
        'BVRDATE' => null,
        'EMPLOYEEEECLASSIFICATIONID' => null,
        'PRIVYSEAL' => null,
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->define(Person::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_ZA\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\en_ZA\Person($faker));

    return [
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

$factory->define(SellerList::class, function (Generator $faker) {
    return [
        'BUSINESSTYPEID' => BusinessType::NONE,
        'SELLERLISTSTATUSID' => SellerListStatus::VALUATION,
        'MANDATETYPEID' => MandateType::SOLE,
        'PROPERTYID' => null,
        'OFFICEID' => null,
        'LISTDATE' => null,
        'LISTCODE' => null,
        'EXPIRYDATE' => null,
        'LISTPRICE' => $faker->randomFloat(3),
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
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(SellerList::class, 'full', function (Generator $faker) {
    return [
        'PROPERTYID' => function () {
            return factory(Property::class)->states('full')->create()->ID;
        },
        'OFFICEID' => function () {
            return factory(Office::class)->states('full')->create()->ID;
        },
    ];
});

$factory->define(BuyerList::class, function (Generator $faker) {
    return [
        'BUYERLISTSTATUSID' => BuyerListStatus::DRAFT,
        'ADVERTISINGSOURCEID' => null,
        'OFFICEID' => null,
        'MINPRICE' => 0.000,
        'MAXPRICE' => 0.000,
        'NUMBEDROOMS' => 0,
        'NUMBATHROOMS' => 0,
        'NUMGARAGES' => 0,
        'NUMCARPORTS' => 0,
        'REQUIREMENTS' => null,
        'INTRODUCTIONDATE' => null,
        'BUYERSOURCEOTHER' => null,
        'EXPIRYDATE' => null,
        'COMMENTS' => null,
        'REFERENCE' => null,
        'REFMETHODCREATED' => 'n',
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(BuyerList::class, 'full', function (Generator $faker) {
    return [
        'OFFICEID' => function () {
            return factory(Office::class)->states('full')->create()->ID;
        },
    ];
});

$factory->define(Property::class, function (Generator $faker) {
    return [
        'AGENTLISTID' => null,
        'OFFICEID' => null,
        'PROPERTYTYPEID' => 0,
        'MEASUREMENTSID' => 0,
        'RATESPERIODID' => 0,
        'ERFNO' => null,
        'SECTIONALTITLENO' => null,
        'ERFSIZE' => null,
        'BUILDINGSIZE' => null,
        'RATESAMT' => null,
        'SECTIONALTITLELEVY' => null,
        'HOMEOWNERLEVY' => null,
        'NUMBEDROOMS' => null,
        'NUMBATHROOMS' => null,
        'NUMRECEPTIONROOMS' => null,
        'NUMSTUDIES' => null,
        'NUMFAMILYROOMS' => null,
        'NUMSTOREROOMS' => null,
        'NUMFIREPLACES' => null,
        'NUMGARAGES' => null,
        'NUMCARPORTS' => null,
        'NUMPARKING' => null,
        'NUMFLATLETS' => null,
        'PROPERTYTITLETYPEID' => 0,
        'PHYSICALADDRESSID' => null,
        'UNITNAME' => null,
        'UNITNUMBER' => null,
        'STREETNUMBER' => null,
        'PHYSICALADDRESS' => $faker->streetAddress,
        'propertyaddress' => null,
        'MANAGINGAGENT' => null,
        'ADDITIONALFEATURES' => null,
        'COMMENTS' => null,
        'GEOLATITUDE' => null,
        'GEOLONGITUDE' => null,
        'LIGHTSTONEID' => null,
        'NUMTVROOM' => null,
        'NUMLOUNGE' => null,
        'NUMDININGROOM' => null,
        'GEOLOCATIONOPTION' => null,
        'NAME' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Property::class, 'full', function (Generator $faker) {
    return [
        'PHYSICALADDRESSID' => function () {
            return factory(MunicipalAreaDefinition::class)->states('full')->create()->ID;
        },
    ];
});

$factory->define(MunicipalAreaDefinition::class, function (Generator $faker) {
    return [
        'P24ID' => null,
        'PROVINCEID' => null,
        'MUNICIPALAREAID' => null,
        'SUBURBID' => null,
        'POSTALCODEID' => null,
    ];
});

$factory->state(MunicipalAreaDefinition::class, 'full', function (Generator $faker) {
    return [
        'PROVINCEID' => function () {
            return factory(Province::class)->create()->ID;
        },
        'MUNICIPALAREAID' => function () {
            return factory(MunicipalArea::class)->create()->ID;
        },
        'SUBURBID' => function () {
            return factory(Suburb::class)->create()->ID;
        },
        'POSTALCODEID' => 0,
    ];
});

$factory->define(Province::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->state,
    ];
});

$factory->define(MunicipalArea::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->state,
    ];
});

$factory->define(Suburb::class, function (Generator $faker) {
    return [
        'ITEM' => $faker->state,
    ];
});

$factory->define(Office::class, function (Generator $faker) {
    return [
        'OFFICESTATUSID' => OfficeStatus::ACTIVE,
        'PHYSICALADDRESSID' => 1,
        'FRANCHISEID' => null,
        'NAME' => $faker->company,
        'SPEEDDIAL' => null,
        'TEL' => $faker->e164PhoneNumber,
        'TELEPHONESANITIZED' => null,
        'FAX' => null,
        'EMAIL' => null,
        'PHYSICALADDRESS' => null,
        'POSTALADDRESS' => null,
        'UNITNAME' => null,
        'STREETNUMBER' => null,
        'STREETNAME' => '',
        'GEOLATITUDE' => $faker->latitude(),
        'GEOLONGITUDE' => $faker->longitude(),
        'COMMENTS' => null,
        'TWITTERACCOUNT' => null,
        'GOOGLEACCOUNT' => null,
        'FACEBOOKACCOUNT' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Office::class, 'full', function (Generator $faker) {
    return [
        'FRANCHISEID' => function () {
            return factory(Franchise::class)->states('full')->create()->ID;
        },
    ];
});

$factory->define(Franchise::class, function (Generator $faker) {
    return [
        'STAKEHOLDERID' => null,
        'FRANCHISESTATUSID' => FranchiseStatus::ACTIVE,
        'FRANCHISECLASSIFICATIONID' => FranchiseClassification::NONE,
        'NAME' => $faker->company,
        'WEBPORTALNAME' => null,
        'BUSINESSNAMECOR' => null,
        'SALESTARGET' => null,
        'PERCENTGROSS' => null,
        'FRANCHISEFEEPAYABLE' => null,
        'P24FEED' => null,
        'P24OFFICEID' => null,
        'FNBQSID' => null,
        'PGENIEOFFICEID' => null,
        'PGENIEREG' => null,
        'CCMANAGERONLEADS' => null,
        'AGENTLISTID' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});

$factory->state(Franchise::class, 'full', function (Generator $faker) {
    return [
        'STAKEHOLDERID' => function () {
            return factory(Stakeholder::class)->create()->ID;
        },
    ];
});

$factory->define(Stakeholder::class, function (Generator $faker) {
    return [
        'STAKEHOLDERSTATUSID' => StakeholderStatus::ACTIVE,
        'STAKEHOLDERTYPEID' => StakeholderType::FRANCHISE,
        'BANKID' => Bank::NONE,
        'NAME' => $faker->company,
        'COMPANYNO' => null,
        'VATREGNO' => null,
        'FFCNO' => null,
        'BANKACCOUNTNO' => null,
        'BANKCODE' => null,
        'CREATED' => $faker->dateTime(),
        'UPDATED' => $faker->dateTime(),
    ];
});
