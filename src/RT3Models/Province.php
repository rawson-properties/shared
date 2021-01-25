<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\ProvinceFactory;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';

    protected static function newFactory()
    {
        return ProvinceFactory::new();
    }
}
