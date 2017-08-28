<?php

namespace Rawson\Shared\RT3Models;

class Property extends Model
{
    protected $table = 'property';

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'PROPERTYTYPEID', 'ID');
    }
}
