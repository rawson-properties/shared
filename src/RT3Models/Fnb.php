<?php

namespace Rawson\Shared\RT3Models;

class Fnb extends Model
{
    protected $table = 'fnb';

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'ID', 'FNBID');
    }
}
