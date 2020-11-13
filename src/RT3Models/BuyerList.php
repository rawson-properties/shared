<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rawson\Shared\Database\Factories\BuyerListFactory;

class BuyerList extends Model
{
    use HasFactory;

    protected $table = 'buyerlist';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

    protected static function newFactory()
    {
        return BuyerListFactory::new();
    }

    // Relations
    public function people()
    {
        return $this->belongsToMany(Person::class, 'personbuyerlist', 'BUYERLISTID', 'PERSONID');
    }

    public function buyerclassification()
    {
        return $this->belongsToMany(
            BuyerClassification::class,
            'buyerlistclassification',
            'BUYERLISTID',
            'BUYERCLASSIFICATIONID'
        );
    }
}
