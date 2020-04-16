<?php

namespace Rawson\Shared\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Registered::class => [
            \Rawson\Shared\Listeners\AmplitudeUserRegistered::class,
        ],
    ];
}
