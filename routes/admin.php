<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'role:admin'
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

        Route::resource(
            'appointments',
            AppointmentController::class
        )
            ->only([
                'index',
            ]);


        Route::patch(
            'appointments/{appointment}/status',
            [
                AppointmentController::class,
                'updateStatus'
            ]
        )
            ->name('appointments.update-status');


        Route::patch(
            'appointments/{appointment}/cancel',
            [
                AppointmentController::class,
                'cancel'
            ]
        )
            ->name('appointments.cancel');

        Route::resource(
            'schedules',
            ScheduleController::class
        )
            ->only([
                'index',
                'edit',
                'update',
            ]);

        Route::get(
            'history',
            [
                HistoryController::class,
                'index'
            ]
        )
            ->name('history.index');

        Route::get(
            'reports',
            [
                ReportController::class,
                'index',
            ]
        )->name('reports.index');

        Route::get(
            'reports/pdf',
            [
                ReportController::class,
                'exportPdf',
            ]
        )->name('reports.pdf');

        Route::get(
            'reports/excel',
            [
                ReportController::class,
                'exportExcel',
            ]
        )->name('reports.excel');
    });
