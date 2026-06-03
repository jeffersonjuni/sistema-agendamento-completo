<?php

use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')
    ->name('dashboard');

Route::view('/admin/components', 'admin.components.index')
    ->name('admin.components');
