<?php

namespace Rawson\Shared\RT3Models;

class SaleOtherServicesOption extends Model
{
    protected $table = 'saleotherservicesoption';

    const NO = 1;
    const OTHERAGENCY = 2;
    const SELLER = 3;
    const YES = 4;
}
