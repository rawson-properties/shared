<?php

namespace Rawson\Shared\RT3Models;

class AgentSellerList extends Model
{
    protected $table = 'agentsellerlist';

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'AGENTLISTID', 'ID');
    }

    public function sellerList()
    {
        return $this->belongsTo(SellerList::class, 'SELLERLISTID', 'ID');
    }

    public function agentListType()
    {
        return $this->belongsTo(AgentListType::class, 'AGENTLISTTYPEID', 'ID');
    }
}
