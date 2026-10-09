<?php
use Illuminate\Support\Facades\Route;
Route::get('/', fn () => response()->json([
    'application' => config('app.name'),
    'module' => 'Penetapan Beasiswa dari SK',
    'status' => 'foundation',
]))->name('home');
