<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');

});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/services.php';
require __DIR__.'/appointments.php';
