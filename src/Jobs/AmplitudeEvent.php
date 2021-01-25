<?php

namespace Rawson\Shared\Jobs;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class AmplitudeEvent implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $name;
    protected $params;
    protected $identity;

    public function __construct(string $name, array $params = null, string $identity = 'Unknown')
    {
        $this->name = $name;
        $this->params = array_merge($params ?? [], [ 'Tool Name' => config('amplitude.tool'), ]);
        $this->identity = md5($identity);
    }

    public function handle()
    {
        if (!config('amplitude.key')) {
            return Log::debug(sprintf('Skipping %s with no config key', __CLASS__));
        }

        $payload = (object) [
            'api_key' => config('amplitude.key'),
            'events' => [
                [
                    'user_id' => $this->identity,
                    'event_type' => $this->name,
                    'time' => now()->getPreciseTimestamp(3),
                    'event_properties' => $this->params,
                ],
            ],
        ];

        $client = new GuzzleClient();
        $client->post('https://api.amplitude.com/2/httpapi', [
            'json' => $payload,
        ]);
    }
}
