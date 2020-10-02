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

    public function courseHistory()
    {
        return $this->hasMany(CourseHistory::class, 'EMPLOYEEID', 'ID');
    }

    public function repSalesDetails()
    {
        return $this->hasMany(RepSalesDetail::class, 'employeeid', 'ID');
    }

    public function repAchieverDetails2016()
    {
        return $this->hasMany(RepAchieverDetail2016::class, 'employeeid', 'ID');
    }
}
