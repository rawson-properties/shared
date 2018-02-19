<?php

namespace Rawson\Shared\RT3Models;

class SellerList extends Model
{
    protected $table = 'sellerlist';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    // Relations
    public function people()
    {
        return $this->belongsToMany(Person::class, 'personsellerlist', 'SELLERLISTID', 'PERSONID');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'agentsellerlist', 'SELLERLISTID', 'AGENTLISTID');
    }

    public function p24()
    {
        return $this->hasOne(P24::class, 'ID', 'P24ID');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'ID', 'OFFICEID');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'PROPERTYID', 'ID');
    }

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'BUSINESSTYPEID', 'ID');
    }
}
