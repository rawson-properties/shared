<?php

namespace Rawson\Shared\RT3Models;

class StakeholderType extends Model
{
    protected $table = 'stakeholdertype';

    const NONE = 1;
    const FRANCHISE = 2;
    const AFFILIATE = 3;
    const ASSOCIATE = 4;
}
