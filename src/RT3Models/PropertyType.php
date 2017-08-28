<?php

namespace Rawson\Shared\RT3Models;

class PropertyType extends Model
{
    protected $table = 'propertytype';

    /**
     * @return bool
     */
    public function isResidential()
    {
        return in_array($this->RESIDENTIAL, [ 'y', 'Y', 'yes', 'YES', true, ], true);
    }
}
