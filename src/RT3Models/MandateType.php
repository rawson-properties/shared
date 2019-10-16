<?php

namespace Rawson\Shared\RT3Models;

class MandateType extends Model
{
    protected $table = 'mandatetype';

    const NONE = 1;
    const SOLE = 2;
    const AUCTION = 3;
    const JOINT = 4;
    const OPEN = 5;
    const PRIVATETENDER = 6;
    const RENTAL = 7;
}
