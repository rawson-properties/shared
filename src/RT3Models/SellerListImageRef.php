<?php

namespace Rawson\Shared\RT3Models;

class SellerListImageRef extends Model
{
    protected $table = 'sellerlistimageref';

    // Relations
    public function propertyImageRef()
    {
        return $this->belongsTo(PropertyImageRef::class, 'PROPERTYIMAGEREFID', 'ID');
    }

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'SELLERLISTID', 'ID');
    }
}
