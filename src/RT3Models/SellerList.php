<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Builder;

class SellerList extends Model
{
    protected $table = 'sellerlist';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    public function scopeIsActive(Builder $query): Builder
    {
        return $query
            ->where(function ($query) {
                $query->whereNull('sellerlist.EXPIRYDATE')
                    ->orWhereRaw('sellerlist.EXPIRYDATE > CURRENT_DATE()')
                    ;
            })
            ->whereIn('sellerlist.SELLERLISTSTATUSID', [
                SellerListStatus::LISTING,
                SellerListStatus::SOLDBYRAWSON,
                SellerListStatus::SOLDBYCOMPETITOR,
            ])
            ;
    }

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
