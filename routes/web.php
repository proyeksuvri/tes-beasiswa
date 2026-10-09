<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\ScholarshipProgramController;
use App\Http\Controllers\MasterData\FacultyController;
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
        Route::get('/fakultas', [FacultyController::class, 'index'])->name('faculties.index');
        Route::post('/fakultas', [FacultyController::class, 'store'])->name('faculties.store');
        Route::put('/fakultas/{faculty}', [FacultyController::class, 'update'])->name('faculties.update');
        Route::delete('/fakultas/{faculty}', [FacultyController::class, 'destroy'])->name('faculties.destroy');
        Route::get('/bank', [BankController::class, 'index'])->name('banks.index');
        Route::post('/bank', [BankController::class, 'store'])->name('banks.store');
        Route::put('/bank/{bank}', [BankController::class, 'update'])->name('banks.update');
        Route::delete('/bank/{bank}', [BankController::class, 'destroy'])->name('banks.destroy');
        Route::get('/periode-akademik', [AcademicPeriodController::class, 'index'])->name('periods.index');
        Route::post('/periode-akademik', [AcademicPeriodController::class, 'store'])->name('periods.store');
        Route::put('/periode-akademik/{period}', [AcademicPeriodController::class, 'update'])->name('periods.update');
        Route::delete('/periode-akademik/{period}', [AcademicPeriodController::class, 'destroy'])->name('periods.destroy');
    });

    Route::get('/akses/operasional', fn () => Inertia::render('Dashboard'))
        ->middleware('role:admin,operator,verifikator')
        ->name('access.operational');

    Route::get('/akses/audit', fn () => Inertia::render('Dashboard'))
        ->middleware('role:admin,auditor,pimpinan')
        ->name('access.audit');
});
