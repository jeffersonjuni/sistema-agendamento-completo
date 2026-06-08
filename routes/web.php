<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
require __DIR__.'/services.php';
require __DIR__.'/appointments.php';
