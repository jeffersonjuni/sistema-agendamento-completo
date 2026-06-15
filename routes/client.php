<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:client'
])->group(function () {

    Route::view(
        '/client/dashboard',
        'client.dashboard'
    )->name('client.dashboard');

});
