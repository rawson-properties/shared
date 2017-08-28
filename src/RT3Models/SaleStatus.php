<?php

namespace Rawson\Shared\RT3Models;

class SaleStatus extends Model
{
    protected $table = 'salestatus';

    const DRAFT = 1;
    const SUSPENSIVE = 2;
    const FINAL = 3;
    const CLOSED = 4;
    const CANCELLED = 5;
    const DELETED = 6;
}
