<?php

namespace Rawson\Shared\RT3Models;

class AgentSaleList extends Model
{
    protected $table = 'agentsalelist';

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'AGENTLISTID', 'ID');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'OFFICEID', 'ID');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SALEID', 'ID');
    }
}
