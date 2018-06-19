<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Builder;
use Rawson\Shared\Libs\Hubspot;

class Agent extends Model
{
    protected $table = 'agentlist';
    protected $dates = [
        'UPDATED',
    ];

    public function getName(): string
    {
        return $this->employee->person->FULLNAME;
    }

    public function getEmail(): string
    {
        return $this->employee->person->EMAIL;
    }

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('ACTIVE', 'y');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EMPLOYEEID', 'ID');
    }

    public function sellerLists()
    {
        return $this->belongsToMany(SellerList::class, 'agentsellerlist', 'AGENTLISTID', 'SELLERLISTID');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'OFFICEID', 'ID');
    }

    public function scopeForFullName($query, string $fullName)
    {
        return $query->leftJoin('employee', 'employee.ID', 'agentlist.EMPLOYEEID')
            ->leftJoin('person', 'person.ID', 'employee.PERSONID')
            ->where('agentlist.ACTIVE', 'y')
            ->where('employee.EMPLOYEESTATUSID', EmployeeStatus::ACTIVE)
            ->where('person.FULLNAME', $fullName)
            ;
    }
}
