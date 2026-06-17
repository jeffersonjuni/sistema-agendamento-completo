<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {

    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('client.dashboard');

})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/services.php';
require __DIR__.'/appointments.php';
