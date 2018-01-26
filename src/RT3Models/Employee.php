<?php

namespace Rawson\Shared\RT3Models;

class Employee extends Model
{
    protected $table = 'employee';
    protected $dates = [
        'UPDATED',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'PERSONID', 'ID');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class, 'EMPLOYEEID', 'ID');
    }
}
