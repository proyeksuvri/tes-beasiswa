<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home', [
    'application' => config('app.name'),
    'module' => 'Penetapan Beasiswa dari SK',
    'status' => 'foundation',
]))->name('home');
