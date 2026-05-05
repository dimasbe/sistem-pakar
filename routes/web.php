<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepribadianController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\BasisAturanController;
use App\Http\Controllers\TesController;
use App\Http\Controllers\DetailTesController;


Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

// Admin Authentication (Public)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showAdminRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'adminRegister'])->name('register.submit');
});

// Siswa Authentication (Public)
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/login', [AuthController::class, 'showSiswaLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'siswaLogin'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showSiswaRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'siswaRegister'])->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth.admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Kepribadian Management
    Route::resource('kepribadian', KepribadianController::class)->parameters([
        'kepribadian' => 'id'
    ]);

    // Siswa Management
    Route::resource('siswas', SiswaController::class);

    // Pertanyaan Management
    Route::resource('pertanyaan', PertanyaanController::class);

    // Karir Management
    Route::resource('karir', KarirController::class);

    // Basis Aturan Management
    Route::resource('aturan', BasisAturanController::class);

    // Tes Management (Admin dapat melihat semua tes)
    Route::get('tes/print-all', [TesController::class, 'printAll'])->name('tes.printAll');
    Route::get('tes', [TesController::class, 'adminIndex'])->name('tes.index');
    Route::get('tes/{id}', [TesController::class, 'adminShow'])->name('tes.show');
    Route::delete('tes/{id}', [TesController::class, 'destroy'])->name('tes.destroy');

    // Detail Tes Management
    Route::resource('detail-tes', DetailTesController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Siswa Protected Routes
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->middleware(['auth.siswa'])->group(function () {
    Route::post('/logout', [AuthController::class, 'siswaLogout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'siswaDashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [SiswaController::class, 'profile'])->name('profile');
    Route::put('/profile', [SiswaController::class, 'updateProfile'])->name('profile.update');

    // Tes (Siswa hanya bisa akses tes mereka sendiri)
    Route::get('/tes/intro', [TesController::class, 'intro'])->name('tes.intro');
    Route::get('/tes/mulai', [TesController::class, 'create'])->name('tes.create');
    Route::get('/riwayat-tes', [TesController::class, 'myTests'])->name('tes.riwayat');
    Route::get('/tes/mulai', [TesController::class, 'create'])->name('tes.create');
    Route::post('/tes', [TesController::class, 'store'])->name('tes.store');
    Route::get('/tes/{id}', [TesController::class, 'show'])->name('tes.show');
    Route::get('/tes/{id}/hasil', [TesController::class, 'result'])->name('tes.result');
    Route::get('/tes/print/{id}', [TesController::class, 'print'])->name('tes.print');
});

Route::get('/karir', [KarirController::class, 'publicIndex'])->name('karir.public');
Route::get('/karir/{id}', [KarirController::class, 'publicShow'])->name('karir.public.show');
