<?php

namespace Rawson\Shared\Providers;

use App;
use Illuminate\Database\Eloquent\Factory as ModelFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class RawsonSharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/amplitude.php', 'amplitude');
        $this->mergeConfigFrom(__DIR__ . '/../config/crisp.php', 'crisp');
        $this->mergeConfigFrom(__DIR__ . '/../config/img.php', 'img');

        view()->addLocation(__DIR__ . '/../resources/views');

        $this->commands([
            \Rawson\Shared\Commands\HubgluePing::class,
        ]);
    }

    public function boot()
    {
        Paginator::useBootstrap();

        if (App::environment('testing')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->callAfterResolving(ModelFactory::class, function ($factory) {
            $factory->load(__DIR__ . '/../database/factories');
        });
    }
}
