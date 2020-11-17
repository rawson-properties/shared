<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\SuburbFactory;

class Suburb extends Model
{
    use HasFactory;

    protected $table = 'suburb';

    protected static function newFactory()
    {
        return SuburbFactory::new();
    }
}
