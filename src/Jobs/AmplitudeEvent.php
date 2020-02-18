<?php

namespace Rawson\Shared\Jobs;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AmplitudeEvent implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $name;
    protected $params;
    protected $identity;

    public function __construct(string $name, array $params = null, string $identity = null)
    {
        $this->name = $name;
        $this->params = array_merge($params ?? [], [ 'Tool Name' => config('services.amplitude.tool'), ]);
        $this->identity = $identity ? md5($identity) : null;
    }

    public function handle()
    {
        $payload = (object) [
            'api_key' => config('services.amplitude.key', '8f2372023f1e7b896604126f64320a88'),
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
