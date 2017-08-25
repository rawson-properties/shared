<?php

namespace Rawson\Shared\RT3Models;

class BuyerList extends Model
{
    protected $table = 'buyerlist';
    protected $dates = [
        'CREATED',
        'UPDATED',
    ];

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
