<?php

namespace Rawson\Shared\RT3Models;

class BusinessType extends Model
{
    protected $table = 'businesstype';

    const NONE = 1;
    const HEADOFFICE = 2;
    const RAWSONAGRICULTURE = 3;
    const RAWSONPROJECTS = 4;
    const RAWSONPROPERTIES = 5;
    const RAWSONAUCTIONS = 6;
    const RAWSONCOMMERCIAL = 7;
    const RAWSONFINANCIALSERVICES = 8;
    const RAWSONRENTALS = 9;
    const YELLOWFIN = 10;
}
