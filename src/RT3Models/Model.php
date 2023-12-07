<?php

namespace Rawson\Shared\RT3Models;

use App;
use Exception;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $primaryKey = 'ID';
    protected $connection = 'rt3';

    public function __construct()
    {
        $this->connection = env('RT3_DB_CONNECTION', 'rt3');
    }

    public $timestamps = false;

    public static function disabled()
    {
        throw new Exception('RT3 Models are read only!');
    }

    // Disable all the methods that may write data (which we don't want)
    public static function create(array $attributes = [])
    {
        if (App::environment('testing')) {
            parent::create($attributes);
        } else {
            self::disabled();
        }
    }

    public function save(array $options = [])
    {
        if (App::environment('testing')) {
            parent::save($options);
        } else {
            self::disabled();
        }
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (App::environment('testing')) {
            parent::update($attributes, $options);
        } else {
            self::disabled();
        }
    }
}
