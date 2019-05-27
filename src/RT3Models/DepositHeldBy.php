<?php

namespace Rawson\Shared\RT3Models;

class DepositHeldBy extends Model
{
    protected $table = 'depositheldby';

    const NONE = 1;
    const CONVEYANCER = 2;
    const OTHERAGENCY = 3;
    const RAWSONPROPERTIES = 4;
}
