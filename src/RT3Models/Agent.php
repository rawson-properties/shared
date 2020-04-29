<?php

namespace Rawson\Shared\RT3Models;

use Cache;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;

class Agent extends Model
{
    use GeneratesCacheKeys;

    protected $table = 'agentlist';
    protected $dates = [
        'UPDATED',
    ];

    public static function findOrFailCached(int $id): ?self
    {
        $key = self::key([ __FUNCTION__, $id, ]);
        return Cache::remember($key, CarbonInterval::day(), function () use ($id) {
            return self::findOrFail($id);
        });
    }

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
