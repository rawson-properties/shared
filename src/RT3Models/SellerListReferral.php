<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Builder;

class SellerListReferral extends Model
{
    protected $table = 'sellerlistreferral';

    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'ID', 'PROPERTYID');
    }

    public function referringOffice()
    {
        return $this->hasOne(Office::class, 'ID', 'REFERRINGOFFICEID');
    }

    public function referredOffice()
    {
        return $this->hasOne(Office::class, 'ID', 'REFERREDOFFICEID');
    }
}
