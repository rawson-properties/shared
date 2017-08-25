<?php

namespace Rawson\Shared\RT3Models;

class FranchiseStatus extends Model
{
    protected $table = 'franchisestatus';

    const NONE = 1;
    const ACTIVE = 2;
    const INACTIVE = 3;
    const RESIGNED = 4;
}
