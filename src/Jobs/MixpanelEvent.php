<?php

namespace Rawson\Shared\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mixpanel;

class MixpanelEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $params;
    protected $identity;

    public function __construct(string $name, array $params = null, string $identity = null)
    {
        $this->name = $name;
        $this->params = $params;
        $this->identity = $identity;
    }

    public function handle()
    {
        $mp = Mixpanel::getInstance(config('services.mixpanel.id'));

        if ($this->identity) {
            $mp->identify(md5($this->identity));
        }

        $mp->track($this->name, $this->params);
    }
}
