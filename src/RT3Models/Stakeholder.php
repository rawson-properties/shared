<?php

namespace Rawson\Shared\RT3Models;

class Stakeholder extends Model
{
    protected $table = 'stakeholder';

    public function franchise()
    {
        return $this->hasOne(Franchise::class, 'STAKEHOLDERID', 'ID');
    }
}
