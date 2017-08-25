<?php

namespace Rawson\Shared\RT3Models;

class BuyerListStatus extends Model
{
    protected $table = 'buyerliststatus';

    const DRAFT = 1;
    const SUBMITTED = 2;
    const ACCEPTED = 3;
    const DECLINED = 4;
    const EXPIRED = 5;
    const ARCHIVED = 6;
    const PROFILE = 7;
}
