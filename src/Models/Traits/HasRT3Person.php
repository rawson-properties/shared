<?php

namespace Rawson\Shared\Models\Traits;

use Rawson\Shared\RT3Models\Agent as RT3Agent;
use Rawson\Shared\RT3Models\Office as RT3Office;
use Rawson\Shared\RT3Models\Person as RT3Person;

trait HasRT3Person
{
    protected $defaultAgent = false;
    protected $defaultOffice = false;

    public function getDefaultAgentAttribute(): ?RT3Agent
    {
        if ($this->defaultAgent === false) {
            $this->defaultAgent = session('user.default_rt3_agent_id')
                ? RT3Agent::findOrFail(session('user.default_rt3_agent_id'))
                : object_get($this, 'rt3Person.default_agent')
                ;
        }

        return $this->defaultAgent;
    }

    public function getDefaultOfficeAttribute(): ?RT3Office
    {
        if ($this->defaultOffice === false) {
            $this->defaultOffice = object_get($this, 'default_agent.office');
        }

        return $this->defaultOffice;
    }

    public function rt3Person()
    {
        return $this->belongsTo(RT3Person::class, 'rt3_person_id');
    }
}
