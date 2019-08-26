<?php

namespace Rawson\Shared\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Rawson\Shared\Libs\PassportClient;
use Log;

class RewardsLogAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $action;
    protected $data;

    public function __construct(string $email, string $action, object $data = null)
    {
        $this->email = $email;
        $this->action = $action;
        $this->data = $data;
    }

    public function handle()
    {
        $rewardsClient = new PassportClient(
            config('services.rewards.url'),
            config('services.rewards.client_id'),
            config('services.rewards.client_secret')
        );

        $response = $rewardsClient->post('/api/actionlog', [
            'email' => $this->email,
            'action' => $this->action,
            'data' => $this->data,
        ]);

        Log::debug(sprintf('%s request got hash %s', __CLASS__, data_get($response, 'hash')));
    }
}
