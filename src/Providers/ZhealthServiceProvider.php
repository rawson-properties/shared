<?php

namespace Rawson\Shared\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ZhealthServiceProvider extends ServiceProvider
{
    public function map()
    {
        Route::namespace('Rawson\Shared\Http\Controllers')
            ->group(__DIR__ . '/../routes/zhealth.php')
            ;
    }
}
