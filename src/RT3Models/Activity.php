<?php

namespace Rawson\Shared\RT3Models;

class Activity extends Model
{
    protected $table = 'activity';

    public function getRouteKeyName()
    {
        return 'ID';
    }

    public function sellerLists()
    {
        return $this->belongsToMany(SellerList::class, 'sellerlistactivity', 'ACTIVITYID', 'SELLERLISTID');
    }
}
