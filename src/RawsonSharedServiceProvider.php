<?php

namespace Rawson\Shared;

use App;
use Illuminate\Support\ServiceProvider;

class RawsonSharedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (App::environment('testing')) {
            $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

            $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/database/factories');
        }
    }
}
