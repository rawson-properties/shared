<?php

namespace Rawson\Shared\RT3Models;

class PersonAgentList extends Model
{
    protected $table = 'personagentlist';
    protected $dates = [
        'CREATED',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'AGENTLISTID');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'PERSONID');
    }
}
