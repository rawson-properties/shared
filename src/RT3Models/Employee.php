<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Rawson\Shared\Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $dates = [
        'UPDATED',
    ];

    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'PERSONID', 'ID');
    }

    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'EMPLOYEEID', 'ID');
    }

    public function awards(): HasManyThrough
    {
        return $this->hasManyThrough(
            AwardDescription::class,
            EmployeeAward::class,
            'EMPLOYEEID',
            'ID',
            'ID',
            'AWARDDESCRIPTIONID'
        );
    }

    public function courseHistory(): HasMany
    {
        return $this->hasMany(CourseHistory::class, 'EMPLOYEEID', 'ID');
    }

    public function repSalesDetails(): HasMany
    {
        return $this->hasMany(RepSalesDetail::class, 'employeeid', 'ID');
    }

    public function repAchieverDetails2016(): HasMany
    {
        return $this->hasMany(RepAchieverDetail2016::class, 'employeeid', 'ID');
    }
}
