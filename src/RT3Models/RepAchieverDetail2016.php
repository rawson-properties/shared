<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\RepAchieverDetail2016Factory;

class RepAchieverDetail2016 extends Model
{
    use HasFactory;

    protected $table = 'rep_achiever_detail_2016';

    protected static function newFactory()
    {
        return RepAchieverDetail2016Factory::new();
    }
}
