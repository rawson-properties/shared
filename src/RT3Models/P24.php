<?php

namespace Rawson\Shared\RT3Models;

class P24 extends Model
{
    protected $table = 'p24';

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'ID', 'P24ID');
    }
}
