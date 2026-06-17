<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::prefix('client')
    ->middleware([
        'auth',
        'role:client'
    ])
    ->group(function () {

        Route::view(
            '/dashboard',
            'client.dashboard'
        )->name('client.dashboard');

        Route::get(
            '/perfil',
            [ProfileController::class, 'index']
        )->name('client.profile.index');

        Route::patch(
            '/perfil',
            [ProfileController::class, 'updateProfile'
        ])->name('client.profile.update');

        Route::patch(
            '/perfil/senha',
            [ProfileController::class, 'updatePassword']
        )->name('client.profile.password');
    });
