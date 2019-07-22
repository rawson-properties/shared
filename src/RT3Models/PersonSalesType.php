<?php

namespace Rawson\Shared\RT3Models;

class PersonSalesType extends Model
{
    protected $table = 'personsalestype';

    const BUYER = 1;
    const SELLER = 2;
    const MORTGAGEOR = 3;
    const BONDATTORNEY = 12;
    const SALEATTORNEY = 22;
    const BEETLEINSPECTOR = 32;
    const ELECTRICALINSPECTOR = 42;
    const NONE = 43;
}
