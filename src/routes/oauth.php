<?php

Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@login', ]);
Route::post('logout', [ 'as' => 'logout', 'uses' => 'AuthController@logout', ]);

Route::group([ 'prefix' => 'auth', 'as' => 'auth.', ], function () {
    Route::group([ 'middleware' => 'guest', ], function () {
        Route::get('connect', [ 'as' => 'connect', 'uses' => 'AuthController@connect', ]);
        Route::get('callback', [ 'as' => 'callback', 'uses' => 'AuthController@callback', ]);
    });

    Route::group([ 'middleware' => 'auth', ], function () {
        Route::get('connection', [ 'as' => 'connection', 'uses' => 'AuthController@connection', ]);
        Route::post('connection', [ 'as' => 'connection:post', 'uses' => 'AuthController@connectionPost', ]);
    });
});
