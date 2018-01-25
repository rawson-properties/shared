<?php

namespace Rawson\Shared\Commands;

use Artisan;
use Illuminate\Console\Command;
use Rawson\Shared\Libs\Hubglue;

class HubgluePing extends Command
{
    protected $signature = 'hubglue:ping';
    protected $description = 'Performs a Ping with the Hubglue library to test connectivity.';

    public function handle()
    {
        $response = Hubglue::ping();
        $this->info($response);
    }
}
