<?php

namespace Rawson\Shared\RT3Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\SaleFactory;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';

    protected static function newFactory()
    {
        return SaleFactory::new();
    }

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

    public function agentSaleList()
    {
        return $this->hasMany(AgentSaleList::class, 'SALEID', 'ID');
    }
}
