<?php

Route::get('ping', function () {
    DB::connection(config('database.default'))->select('SELECT NOW()');

    if (config('database.connections.rt3')) {
        DB::connection('rt3')->select('SELECT NOW()');
    }

    return response('pong');
})->name('ping');
