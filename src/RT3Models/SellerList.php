<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\SellerListFactory;

class SellerList extends Model
{
    use HasFactory;

    protected $table = 'sellerlist';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    protected $firstImage;

    protected static function newFactory()
    {
        return SellerListFactory::new();
    }

    public function getFirstImageAttribute()
    {
        if (!$this->firstImage) {
            $sellerImage = $this->sellerListImageRefs->where('DISPLAY', 'y')->first();
            if ($sellerImage) {
                $this->firstImage = $sellerImage->propertyImageRef;
            }
        }

        return $this->firstImage;
    }

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

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'BUSINESSTYPEID', 'ID');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'ID', 'OFFICEID');
    }

    public function p24()
    {
        return $this->hasOne(P24::class, 'ID', 'P24ID');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'PROPERTYID', 'ID');
    }

    public function sellerListImageRefs()
    {
        return $this->hasMany(SellerListImageRef::class, 'SELLERLISTID', 'ID')
            ->orderBy('SORTORDER', 'ASC')
            ;
    }

    public function sellerListStatus()
    {
        return $this->hasOne(SellerListStatus::class, 'ID', 'SELLERLISTSTATUSID');
    }

    public function rawsoncoza()
    {
        return $this->hasOne(Rawsoncoza::class, 'ID', 'RAWSONCOZAID');
    }
}
