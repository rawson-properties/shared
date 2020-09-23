<?php

namespace Rawson\Shared\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class RawsonSharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/amplitude.php', 'amplitude');
        $this->mergeConfigFrom(__DIR__ . '/../config/appcues.php', 'appcues');
        $this->mergeConfigFrom(__DIR__ . '/../config/crisp.php', 'crisp');
        $this->mergeConfigFrom(__DIR__ . '/../config/img.php', 'img');

        view()->addLocation(__DIR__ . '/../resources/views');

        $this->commands([
            \Rawson\Shared\Commands\HubgluePing::class,
        ]);
    }

    public function boot()
    {
        /* This has all changed for Laravel 8
        if (App::environment('testing')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../database/factories');
        */
    }
}
