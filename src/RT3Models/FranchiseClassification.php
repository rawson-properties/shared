<?php

namespace Rawson\Shared\RT3Models;

class FranchiseClassification extends Model
{
    protected $table = 'franchiseclassification';

    const NONE = 1;
    const NORTH = 2;
    const SOUTH = 3;
    const KZN = 12;
    const EC = 22;
}
