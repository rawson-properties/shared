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
        if (!$this->rt3_person_id) {
            return null;
        }

        if ($this->defaultAgent === false) {
            $this->defaultAgent = session('user.default_rt3_agent_id')
                ? RT3Agent::findOrFailCached(session('user.default_rt3_agent_id'))
                : RT3Person::defaultAgentForPersonID($this->rt3_person_id)
                ;
        }

        return $this->defaultAgent;
    }

    public function getDefaultOfficeAttribute(): ?RT3Office
    {
        if ($this->defaultOffice === false) {
            $agent = $this->default_agent;
            if (!$agent || !$agent->OFFICEID) {
                return null;
            }

            $this->defaultOffice = RT3Office::findOrFailCached($agent->OFFICEID);
        }

        return $this->defaultOffice;
    }

    public function rt3Person()
    {
        return $this->belongsTo(RT3Person::class, 'rt3_person_id');
    }
}
