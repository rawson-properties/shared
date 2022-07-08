<?php

namespace Rawson\Shared\RT3Models;

use Cache;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Rawson\Shared\Database\Factories\EmployeeFactory;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;

class Employee extends Model
{
    use GeneratesCacheKeys;
    use HasFactory;

    protected $table = 'employee';
    protected $dates = [
        'UPDATED',
    ];

    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }

    public function getIsPinnacleClubAttribute(): bool
    {
        $key = self::key([ __FUNCTION__, $this->ID, ]);
        return Cache::remember($key, CarbonInterval::hours(2), function () {
            $march = Carbon::parse('1st March this year');
            $displayStartAt = now()->lt($march) ? $march->copy()->subYear() : $march;

            $status = $this->awards()
                ->whereIn('awarddescription.ID', [ 355, 357, ]) // Hardcoded IDs for Pinnacle Club awards
                ->whereBetween('DATE', [
                    $displayStartAt->copy()->startOfYear(),
                    $displayStartAt->copy()->endOfYear(),
                ])
                ->count();

            return $status > 0;
        });
    }

    public function getAchieverStatusAttribute(): ?string
    {
        $achieverDetails = $this->repAchieverDetails2016()->first();
        return $achieverDetails && $achieverDetails->currStatus !== 'No Status'
            ? $achieverDetails->currStatus
            : null;
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
