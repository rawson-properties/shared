<?php

namespace Rawson\Shared\RT3Models;

use Cache;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\AgentFactory;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use Rawson\Shared\Models\Traits\FindOrFailCached;

class Agent extends Model
{
    use FindOrFailCached, HasFactory, GeneratesCacheKeys;

    protected $table = 'agentlist';
    protected $dates = [
        'UPDATED',
    ];

    protected static function newFactory()
    {
        return AgentFactory::new();
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
        if (!array_key_exists('job_title', $this->attributes)) {
            $key = self::key([ __FUNCTION__, $this->ID, ]);
            $this->attributes['job_title'] = Cache::remember($key, CarbonInterval::hours(6), function () {
                if ($this->employee->person->JOBTITLEID === 1) {
                    return null;
                }

                return $this->employee->person->jobTitle->ITEM;
            });
        }

        return $this->attributes['job_title'];
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

    public static function findByEmail(string $email)
    {
        return self::join('employee', 'employee.ID', 'agentlist.EMPLOYEEID')
            ->join('person', 'person.ID', 'employee.PERSONID')
            ->where('agentlist.ACTIVE', 'y')
            ->where('agentlist.DEFAULTOFFICE', 'y')
            ->where('EMAIL', $email)
            ->first();
    }
}
