<?php

namespace Rawson\Shared\RT3Models;

class PhysicalAddress extends Model
{
    protected $table = 'municipalareadefinition';

    public function province()
    {
        return $this->belongsTo(Province::class, 'PROVINCEID', 'ID');
    }

    public function suburb()
    {
        return $this->belongsTo(Suburb::class, 'SUBURBID', 'ID');
    }
}
