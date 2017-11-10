<?php

namespace Rawson\Shared\RT3Models;

class MunicipalAreaDefinition extends Model
{
    protected $table = 'municipalareadefinition';

    // Relations
    public function province()
    {
        return $this->hasOne(Province::class, 'ID', 'PROVINCEID');
    }

    public function suburb()
    {
        return $this->hasOne(Suburb::class, 'ID', 'SUBURBID');
    }

    public function municipalArea()
    {
        return $this->hasOne(MunicipalArea::class, 'ID', 'MUNICIPALAREAID');
    }
}
