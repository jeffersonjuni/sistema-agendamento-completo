<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\HistoryController;
use App\Http\Controllers\Client\DashboardController;

Route::prefix('client')
    ->name('client.')
    ->middleware([
        'auth',
        'role:client'
    ])
    ->group(function () {

        Route::get(
            '/dashboard',
            [
                DashboardController::class,
                'index'
            ]
        )
            ->name('dashboard');

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

        Route::get(
            'appointments/available-times',
            [
                AppointmentController::class,
                'availableTimes'
            ]
        )->name('appointments.available-times');

        Route::patch(
            'appointments/{appointment}/cancel',
            [
                AppointmentController::class,
                'cancel'
            ]
        )
            ->name('appointments.cancel');


        Route::get(
            'appointments/schedules',
            [
                AppointmentController::class,
                'schedules'
            ]
        )->name('appointments.schedules');

        Route::get(
            'history',
            [
                HistoryController::class,
                'index'
            ]
        )
            ->name('history.index');

    });
