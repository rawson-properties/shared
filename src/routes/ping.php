<?php

Route::get('ping', function () {
    return response('pong');
})->name('ping');
