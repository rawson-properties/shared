<?php

namespace Rawson\Shared\RT3Models;

class SellerListStatusHistory extends Model
{
    protected $table = 'sellerliststatushistory';

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'SELLERLISTID', 'ID');
    }

    public function sellerListStatus()
    {
        return $this->hasOne(SellerListStatus::class, 'ID', 'SELLERLISTSTATUSID');
    }
}
