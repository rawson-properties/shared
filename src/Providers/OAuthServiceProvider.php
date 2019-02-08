<?php

namespace Rawson\Shared\Providers;

use App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class OAuthServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::register(\Laravel\Socialite\SocialiteServiceProvider::class);
    }

    public function map()
    {
        Route::middleware('web')
            ->namespace('Rawson\Shared\Http\Controllers')
            ->group(__DIR__ . '/../routes/oauth.php')
            ;
    }
}
