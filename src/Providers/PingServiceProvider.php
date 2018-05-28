<?php

namespace Rawson\Shared\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class PingServiceServiceProvider extends ServiceProvider
{
    public function map()
    {
        Route::namespace('Rawson\Shared\Http\Controllers')
            ->group(__DIR__ . '/../routes/ping.php')
            ;
    }
}
