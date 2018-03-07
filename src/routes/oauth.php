<?php

Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@login', ]);

Route::group([ 'prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'guest', ], function () {
    Route::get('connect', [ 'as' => 'connect', 'uses' => 'AuthController@connect', ]);
    Route::get('callback', [ 'as' => 'callback', 'uses' => 'AuthController@callback', ]);
});