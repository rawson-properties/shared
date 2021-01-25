<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\PropertyFactory;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';

    protected static function newFactory()
    {
        return PropertyFactory::new();
    }

    public function getAddress(): string
    {
        return trim(implode(' ', [
            $this->UNITNUMBER,
            $this->UNITNAME,
            $this->STREETNUMBER,
            $this->PHYSICALADDRESS,
        ]));
    }

    public function getAddress2(): string
    {
        return trim(implode(' ', [
            $this->municipalAreaDefinition->municipalArea->ITEM,
            $this->municipalAreaDefinition->suburb->ITEM,
            $this->municipalAreaDefinition->province->ITEM,
        ]));
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'PROPERTYTYPEID', 'ID');
    }

    public function municipalAreaDefinition()
    {
        return $this->belongsTo(MunicipalAreaDefinition::class, 'PHYSICALADDRESSID', 'ID');
    }

    public function sellerReferalSummary()
    {
        return $this->hasMany(SellerReferalSummary::class, 'propertyid', 'ID');
    }

    public function propertyFeatures()
    {
        return $this->hasMany(PropertyFeature::class, 'PROPERTYID', 'ID');
    }
}
