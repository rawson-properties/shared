<?php

namespace Rawson\Shared\RT3Models;

use Exception;

class Sale extends Model
{
    protected $table = 'sale';

    public function scopeFinalOrClosed($q)
    {
        return $q->whereIn('SALESTATUSID', [3, 4]); // @TODO: Use SaleStatus::consts
    }

    public function scopeRecent($q)
    {
        return $q->where('SALEDATE', '>', now()->subYear());
    }

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'SELLERLISTID', 'ID');
    }

    public function saleSaleStatus()
    {
        return $this->hasMany(SaleSaleStatus::class, 'SALEID', 'ID');
    }
}
