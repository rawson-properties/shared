<?php

namespace Rawson\Shared\RT3Models;

use Exception;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $primaryKey = 'ID';
    protected $connection = 'rt3';

    public static function disabled()
    {
        throw new Exception('RT3 Models are read only!');
    }

    // Disable all the methods that may write data (which we don't want)
    public static function create(array $attributes = [])
    {
        self::disabled();
    }

    public function save(array $options = [])
    {
        self::disabled();
    }

    public function update(array $attributes = [], array $options = [])
    {
        self::disabled();
    }
}
