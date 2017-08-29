<?php

namespace Rawson\Shared\RT3Models;

class StakeholderStatus extends Model
{
    protected $table = 'stakeholderstatus';

    const NONE = 1;
    const ACTIVE = 2;
    const INACTIVE = 3;
    const RESIGNED = 4;
}
