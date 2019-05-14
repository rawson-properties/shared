<?php

namespace Rawson\Shared\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class RawsonSharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/hubspot.php', 'hubspot');
        $this->mergeConfigFrom(__DIR__ . '/../config/crisp.php', 'crisp');

        view()->addLocation(__DIR__ . '/../resources/views');

        $this->commands([
            \Rawson\Shared\Commands\HubgluePing::class,
        ]);
    }

    public function boot()
    {
        if (App::environment('testing')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../database/factories');
    }
}
