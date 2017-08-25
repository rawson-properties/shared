<?php

namespace Rawson\Shared\RT3Models;

class OfficeStatus extends Model
{
    protected $table = 'officestatus';

    const NONE = 1;
    const ACTIVE = 2;
    const INACTIVE = 3;
    const RESIGNED = 4;
}
