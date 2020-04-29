<?php

namespace Rawson\Shared\RT3Models;

use Cache;
use Carbon\CarbonInterval;
use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;

class Person extends Model
{
    use GeneratesCacheKeys;

    protected $table = 'person';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    protected $defaultAgent = false;

    public function getDefaultAgentAttribute(): ?Agent
    {
        if ($this->defaultAgent === false) {
            $key = self::key([ __FUNCTION__, $this->ID, ]);
            $this->defaultAgent = Cache::remember($key, CarbonInterval::hours(6), function () {
                if (!$this->employee) {
                    return;
                }

                return $this->employee->agents()
                    ->where('agentlist.ACTIVE', 'y')
                    ->orderBy('agentlist.DEFAULTOFFICE', 'DESC')
                    ->orderBy('agentlist.UPDATED', 'DESC')
                    ->first()
                    ;
            });
        }

        return $this->defaultAgent;
    }

    public static function findOrFailCached(int $id): ?self
    {
        $key = self::key([ __FUNCTION__, $id, ]);
        return Cache::remember($key, CarbonInterval::day(), function () use ($id) {
            return self::findOrFail($id);
        });
    }

    public static function defaultAgentForPersonID(int $id): ?Agent
    {
        $key = self::key([ __FUNCTION__, $id, ]);
        return Cache::remember($key, CarbonInterval::hours(6), function () use ($id) {
            $person = self::findOrFailCached($id);
            return $person->default_agent;
        });
    }

    // Relations
    public function title()
    {
        return $this->belongsTo(Title::class, 'TITLEID', 'ID');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'JOBTITLEID', 'ID');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'PERSONID');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'personagentlist', 'PERSONID', 'AGENTLISTID');
    }

    public function buyerlist()
    {
        return $this->belongsToMany(BuyerList::class, 'personbuyerlist', 'PERSONID', 'BUYERLISTID');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'personsales', 'PERSONID', 'SALESID')
            ->withPivot([
                'PERSONSALESTYPEID',
                'CLIENTTYPEID',
            ])
            ;
    }

    public function sellerlist()
    {
        return $this->belongsToMany(SellerList::class, 'personsellerlist', 'PERSONID', 'SELLERLISTID');
    }

    public function sellerReferralSummaries()
    {
        return $this->belongsToMany(
            SellerReferalSummary::class,
            'personsellerlistreferral',
            'PERSONID',
            'SELLERLISTREFERRALID'
        );
    }

    public function advertisingsource()
    {
        return $this->belongsToMany(AdvertisingSource::class, 'personsource', 'PERSONID', 'ADVERTISINGSOURCEID');
    }

    public function buyerReferalSummary()
    {
        return $this->hasMany(BuyerReferalSummary::class, 'personid', 'ID');
    }
}
