<?php

namespace Rawson\Shared\RT3Models;

class Franchise extends Model
{
    protected $table = 'franchise';

    public function businessTypes()
    {
        return $this->belongsToMany(BusinessType::class, 'franchisebusinesstype', 'FRANCHISEID', 'BUSINESSTYPEID');
    }

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class, 'STAKEHOLDERID', 'ID');
    }
}
