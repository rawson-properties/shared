<?php

namespace Rawson\Shared\RT3Models;

class AdvertisingSource extends Model
{
    protected $table = 'advertisingsource';

    public function advertisingSourceItem()
    {
        return $this->belongsTo(AdvertisingSourceItem::class, 'ADVERTISINGSOURCEITEMID', 'ID');
    }
}
