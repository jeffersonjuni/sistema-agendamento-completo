<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::prefix('client')
    ->name('client.')
    ->middleware([
        'auth',
        'role:client'
    ])
    ->group(function () {

        Route::view(
            '/dashboard',
            'client.dashboard'
        )->name('dashboard');

        Route::get(
            '/perfil',
            [ProfileController::class, 'index']
        )->name('profile.index');

        Route::patch(
            '/perfil',
            [
                ProfileController::class,
                'updateProfile'
            ]
        )->name('profile.update');

        Route::patch(
            '/perfil/senha',
            [ProfileController::class, 'updatePassword']
        )->name('profile.password');
    });
