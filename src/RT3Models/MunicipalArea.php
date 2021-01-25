<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\MunicipalAreaFactory;

class MunicipalArea extends Model
{
    use HasFactory;

    protected $table = 'municipalarea';

    protected static function newFactory()
    {
        return MunicipalAreaFactory::new();
    }

    // Relations
    public function municipalAreaDefinitions()
    {
        return $this->hasMany(MunicipalAreaDefinition::class, 'MUNICIPALAREAID', 'ID');
    }
}
