<?php

namespace Rawson\Shared\RT3Models;

class Franchise extends Model
{
    protected $table = 'franchise';

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class, 'STAKEHOLDERID', 'ID');
    }
}
