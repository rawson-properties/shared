<?php

namespace Rawson\Shared\RT3Models;

class SellerListHistory extends Model
{
    protected $table = 'sellerlisthistory';

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'SELLERLISTID', 'ID');
    }
}
