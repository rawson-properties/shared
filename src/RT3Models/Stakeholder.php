<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\StakeholderFactory;

class Stakeholder extends Model
{
    use HasFactory;

    protected $table = 'stakeholder';

    protected static function newFactory()
    {
        return StakeholderFactory::new();
    }

    public function franchise()
    {
        return $this->hasOne(Franchise::class, 'STAKEHOLDERID', 'ID');
    }
}
