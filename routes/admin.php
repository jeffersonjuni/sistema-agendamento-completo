<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ServiceController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'role:admin'
    ])
    ->group(function () {

        Route::view(
            '/dashboard',
            'admin.dashboard'
        )->name('dashboard');

        Route::view(
            '/components',
            'admin.components.index'
        )->name('components');

        Route::get(
            '/perfil',
            [ProfileController::class, 'index']
        )->name('profile.index');

        Route::patch(
            '/perfil',
            [ProfileController::class, 'updateProfile']
        )->name('profile.update');

        Route::patch(
            '/perfil/senha',
            [ProfileController::class, 'updatePassword']
        )->name('profile.password');

        Route::patch(
            'services/{service}/toggle-status',
            [ServiceController::class, 'toggleStatus']
        )->name('services.toggle-status');


        Route::resource('services', ServiceController::class);
    });
