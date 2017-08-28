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

    /*
     * Look at my status and return the corresponding Hubspot Deal Stage
     */
    public function getHubspotDealStage(): string
    {
        switch ($this->SALESTATUSID) {
            case SaleStatus::SUSPENSIVE:
                return config('hubspot.dealstage.deed_of_sale');
                break;
            case SaleStatus::FINAL:
                return config('hubspot.dealstage.deed_of_sale');
                break;
            case SaleStatus::CLOSED:
                return config('hubspot.dealstage.transfer');
                break;
            case SaleStatus::CANCELLED:
                return config('hubspot.dealstage.cancelled');
                break;
            default:
                throw new Exception('Unsupported Hubspot Deal Stage!');
        }
    }
}
