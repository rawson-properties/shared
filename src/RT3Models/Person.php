<?php

namespace Rawson\Shared\RT3Models;

class Person extends Model
{
    protected $table = 'person';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    protected $defaultAgent = false;

    public function getDefaultAgentAttribute(): ?Agent
    {
        if ($this->defaultAgent === false) {
            $this->defaultAgent = $this->employee->agents()
                ->where('agentlist.ACTIVE', 'y')
                ->orderBy('agentlist.DEFAULTOFFICE', 'DESC')
                ->orderBy('agentlist.UPDATED', 'DESC')
                ->first()
                ;
        }

        return $this->defaultAgent;
    }

    // Relations
    public function title()
    {
        return $this->belongsTo(Title::class, 'TITLEID', 'ID');
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

    public function sellerlist()
    {
        return $this->belongsToMany(SellerList::class, 'personsellerlist', 'PERSONID', 'SELLERLISTID');
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
