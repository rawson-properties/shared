<?php

namespace Rawson\Shared\RT3Models;

use DB;
use Illuminate\Support\Collection;
use Rawson\Shared\Models\Traits\FindOrFailCached;

class Office extends Model
{
    use FindOrFailCached;

    protected $table = 'office';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    public static function findNearestToLatLng(
        float $lat,
        float $lng,
        int $businessType = BusinessType::RAWSONPROPERTIES
    ): self {
        return self::findNearToLatLng($lat, $lng, $businessType, 1)->first();
    }

    public static function findNearToLatLng(
        float $lat,
        float $lng,
        int $businessType = BusinessType::RAWSONPROPERTIES,
        int $limit = 5
    ): Collection {
        $distanceQuery = sprintf('(
            6371 * acos (
                cos (radians(%s))
                * cos(radians(GEOLATITUDE))
                * cos(radians(GEOLONGITUDE) - radians(%s))
                + sin (radians(%s))
                * sin(radians(GEOLATITUDE))
            )
        ) AS distance', $lat, $lng, $lat);

        $query = self::select([ '*', DB::raw($distanceQuery), ])
            ->whereNotNull('GEOLATITUDE')
            ->whereNotNull('GEOLONGITUDE')
            ->orderBy('distance')
            ->limit($limit)
            ;

        switch ($businessType) {
            case BusinessType::RAWSONRENTALS:
                $query->where('name', 'LIKE', '% Rentals');
                break;
            case BusinessType::RAWSONCOMMERCIAL:
                $query->where('name', 'LIKE', '% Commercial');
                break;
            default:
                // Unless we're looking for Rentals or Commercial exclude them
                $query->where('name', 'NOT LIKE', '% Rentals');
                $query->where('name', 'NOT LIKE', '% Commercial');
        }

        return $query->get();
    }

    public function address()
    {
        return $this->belongsTo(PhysicalAddress::class, 'PHYSICALADDRESSID', 'ID');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class, 'OFFICEID', 'ID');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'OFFICEID', 'ID');
    }

    public function sellerLists()
    {
        return $this->hasMany(SellerList::class, 'OFFICEID', 'ID');
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'FRANCHISEID', 'ID');
    }
}
