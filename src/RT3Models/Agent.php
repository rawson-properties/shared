<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Builder;
use Rawson\Shared\Models\Traits\FindOrFailCached;

class Agent extends Model
{
    use FindOrFailCached;

    protected $table = 'agentlist';
    protected $dates = [
        'UPDATED',
    ];

    // @TODO: See which projects use this method and refactor in favour of attribute
    public function getName(): string
    {
        return $this->name;
    }

    // @TODO: See which projects use this method and refactor in favour of attribute
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNameAttribute(): string
    {
        return $this->employee->person->FULLNAME;
    }

    public function getFirstNameAttribute(): string
    {
        return $this->employee->person->FIRSTNAME;
    }

    public function getLastNameAttribute(): string
    {
        return $this->employee->person->LASTNAME;
    }

    public function getEmailAttribute(): string
    {
        return $this->employee->person->EMAIL;
    }

    public function getPhotoUrlSmallAttribute(): ?string
    {
        return $this->employee->person->PHOTOURLSMALL;
    }

    public function getPhotoUrlImageLargeAttribute(): ?string
    {
        return $this->employee->person->PHOTOURLLARGE;
    }

    public function getCellphoneAttribute(): ?string
    {
        return $this->employee->person->CELLPHONE;
    }

    public function getJobTitleAttribute(): ?string
    {
        if ($this->employee->person->JOBTITLEID === 1) {
            return null;
        }

        return $this->employee->person->jobTitle->ITEM;
    }

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('ACTIVE', 'y');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EMPLOYEEID', 'ID');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'agentsalelist', 'AGENTLISTID', 'SALEID');
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
