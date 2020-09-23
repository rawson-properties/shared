<?php

namespace Rawson\Shared\Providers;

use App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;

class OAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::register(SocialiteServiceProvider::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/oauth.php', 'oauth');
    }

    public function boot()
    {
        Route::middleware('web')
            ->namespace('Rawson\Shared\Http\Controllers')
            ->group(__DIR__ . '/../routes/oauth.php')
            ;
    }
}
