<?php

namespace Rawson\Shared\RT3Models;

class ActivityStatus extends Model
{
    protected $table = 'activitystatus';

    const SCHEDULED = 1;
    const DONE = 2;
    const CANCELLED = 3;
    const PROCEED = 5;
}
