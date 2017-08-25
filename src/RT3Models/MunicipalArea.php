<?php

namespace Rawson\Shared\RT3Models;

class MunicipalArea extends Model
{
    protected $table = 'municipalarea';

    // Relations
    public function municipalAreaDefinitions()
    {
        return $this->hasMany(MunicipalAreaDefinition::class, 'MUNICIPALAREAID', 'ID');
    }
}
