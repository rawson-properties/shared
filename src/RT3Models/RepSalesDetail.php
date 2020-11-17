<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\RepSalesDetailFactory;

class RepSalesDetail extends Model
{
    use HasFactory;

    protected $table = 'rep_sales_detail';

    protected static function newFactory()
    {
        return RepSalesDetailFactory::new();
    }
}
