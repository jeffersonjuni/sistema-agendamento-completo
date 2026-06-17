<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::prefix('admin')
    ->middleware([
        'auth',
        'role:admin'
    ])
    ->group(function () {

        Route::view(
            '/dashboard',
            'admin.dashboard'
        )->name('admin.dashboard');

        Route::view(
            '/components',
            'admin.components.index'
        )->name('admin.components');

        Route::get(
            '/perfil',
            [ProfileController::class, 'index']
        )->name('admin.profile.index');

        Route::patch(
            '/perfil',
            [ProfileController::class, 'updateProfile']
        )->name('admin.profile.update');

        Route::patch(
            '/perfil/senha',
            [ProfileController::class, 'updatePassword']
        )->name('admin.profile.password');
    });
