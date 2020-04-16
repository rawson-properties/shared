<?php

namespace Rawson\Shared\Listeners;

use Rawson\Shared\Jobs\AmplitudeEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class AmplitudeUserRegistered implements ShouldQueue
{
    public function handle(Registered $event)
    {
        if (!config('amplitude.key') || !data_get($event->user, 'email')) {
            return;
        }

        dispatch(new AmplitudeEvent('User Registered', [], $event->user->email));
    }
}
