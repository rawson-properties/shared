<?php

namespace Rawson\Shared\RT3Models;

class AgentListType extends Model
{
    protected $table = 'agentlisttype';

    const AGENT = 1;
    const REFERRER = 2;
    const AGENTCONTACTED = 3;
    const LEADCOORDINATOR = 6;
}
