<?php

namespace Rawson\Shared\RT3Models;

class Bank extends Model
{
    protected $table = 'bank';

    const NONE = 2;
    const ABSA = 12;
    const CAPITEC = 22;
    const FNB = 32;
    const INVESTEC = 42;
    const NEDBANK = 52;
    const STANDARDBANK = 62;
}
