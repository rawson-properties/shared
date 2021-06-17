<?php

namespace Rawson\Shared\RT3Models;

class SellerListStatus extends Model
{
    protected $table = 'sellerliststatus';

    const VALUATION = 1;
    const LISTING = 2;
    const EXPIRED = 3;
    const SOLDBYRAWSON = 4;
    const SOLDBYCOMPETITOR = 5;
    const GENERATED = 6;
    const COMPETITORSTOCK = 7;
}
