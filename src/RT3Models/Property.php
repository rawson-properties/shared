<?php

namespace Rawson\Shared\RT3Models;

class Property extends Model
{
    protected $table = 'property';

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
}
