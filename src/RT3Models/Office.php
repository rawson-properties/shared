<?php

namespace Rawson\Shared\RT3Models;

class Office extends Model
{
    protected $table = 'office';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'FRANCHISEID', 'ID');
    }

    public function address()
    {
        return $this->belongsTo(PhysicalAddress::class, 'PHYSICALADDRESSID', 'ID');
    }
}
