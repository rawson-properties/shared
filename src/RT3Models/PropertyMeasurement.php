<?php

namespace Rawson\Shared\RT3Models;

class PropertyMeasurement extends Model
{
    protected $table = 'propertymeasurements';

    const NONE = 1;
    const METRES = 2;
    const HECTARES = 3;
}
