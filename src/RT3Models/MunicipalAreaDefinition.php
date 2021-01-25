<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\MunicipalAreaDefinitionFactory;

class MunicipalAreaDefinition extends Model
{
    use HasFactory;

    protected $table = 'municipalareadefinition';

    protected static function newFactory()
    {
        return MunicipalAreaDefinitionFactory::new();
    }

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
