<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\ScholarshipProgramController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('dashboard')
    : redirect()->route('login')
)->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:login');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware('role:admin,operator')->prefix('master')->name('master.')->group(function (): void {
        Route::get('/program-beasiswa', [ScholarshipProgramController::class, 'index'])->name('programs.index');
        Route::post('/program-beasiswa', [ScholarshipProgramController::class, 'store'])->name('programs.store');
        Route::put('/program-beasiswa/{program}', [ScholarshipProgramController::class, 'update'])->name('programs.update');
        Route::delete('/program-beasiswa/{program}', [ScholarshipProgramController::class, 'destroy'])->name('programs.destroy');
    });

    Route::get('/akses/operasional', fn () => Inertia::render('Dashboard'))
        ->middleware('role:admin,operator,verifikator')
        ->name('access.operational');

    Route::get('/akses/audit', fn () => Inertia::render('Dashboard'))
        ->middleware('role:admin,auditor,pimpinan')
        ->name('access.audit');
});
