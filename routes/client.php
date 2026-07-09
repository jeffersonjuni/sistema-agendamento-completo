<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\AppointmentController;

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

        Route::resource(
            'appointments',
            AppointmentController::class
        )->only([
                    'index',
                    'create',
                    'store',
                ]);

        Route::patch(
            'appointments/{appointment}/cancel',
            [
                AppointmentController::class,
                'cancel'
            ]
        )
            ->name('appointments.cancel');
    });
