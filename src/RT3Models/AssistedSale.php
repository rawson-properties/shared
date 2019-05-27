<?php

namespace Rawson\Shared\RT3Models;

class AssistedSale extends Model
{
    protected $table = 'assistedsale';

    const NONE = 1;
    const FNBQUICKSELL = 2;
    const SUMMITABSA = 3;
    const SUMMITNEDBANK = 4;
    const NEDBANK = 5;
    const STDBANK = 6;
    const ABSA = 12;
    const ABSAHELPUSELL = 13;
}
