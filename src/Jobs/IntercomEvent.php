<?php

namespace Rawson\Shared\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intercom\IntercomClient;

class IntercomEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $eventName;
    protected $meta;

    public function __construct(string $email, string $eventName, array $meta = [])
    {
        $this->email = $email;
        $this->eventName = $eventName;
        $this->meta = $meta;
    }

    public function handle()
    {
        $client = new IntercomClient(config('intercom.access_token'), null);

        $payload = [
            'created_at' => time(),
            'event_name' => $this->eventName,
            'email' => $this->email,
        ];

        if ($this->meta) {
            $payload['metadata'] = $this->meta;
        }

        $client->events->create($payload);
    }
}
