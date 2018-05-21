<?php

namespace Rawson\Shared\RT3Models;

class JobTitle extends Model
{
    protected $table = 'jobtitle';

    const NONE = 1;
    const ADMINRECEPTION = 2;
    const FRANCHISEE = 3;
    const HOACCOUNTS = 4;
    const HOADMIN = 5;
    const HOADVERTISINGMARKETING = 6;
    const HOIT = 7;
    const HOMANAGEMENT = 8;
    const OFFICEMANAGER = 9;
    const RENTALPARTNER = 10;
    const RFSADMIN = 11;
    const RFSCONSULTANT = 12;
    const RFSMANAGEMENT = 13;
    const SALESPARTNER = 14;
    const HORSM = 22;
    const HOBUSINESSEXPANSIONDIVISION = 32;
    const SHOWHOUSESITTER = 33;
    const HODIRECTOR = 35;
    const COMMERCIALBROKER = 37;
    const SALESRENTALPARTNER = 39;
}
