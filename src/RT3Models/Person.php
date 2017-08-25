<?php

namespace Rawson\Shared\RT3Models;

class Person extends Model
{
    protected $table = 'person';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    // Relations
    public function title()
    {
        return $this->belongsTo(Title::class, 'TITLEID', 'ID');
    }

    /* @UNUSED
    // Offices for which the user has had activity
    public function getActivityOffices()
    {
        return self::select('office.NAME')
            ->join('activitypersonlist', 'person.ID', 'activitypersonlist.PERSONID')
            ->join('activityagentlist', 'activityagentlist.ACTIVITYID', 'activitypersonlist.ACTIVITYID')
            ->join('agentlist', 'agentlist.ID', 'activityagentlist.AGENTLISTID')
            ->join('office', 'office.ID', 'agentlist.OFFICEID')
            ->where('person.EMAIL', '=', $this->EMAIL)
            ;
    }
    */

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
}
