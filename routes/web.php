<?php

use Illuminate\Support\Facades\Route;

// =====================
// CONTROLLERS
// =====================

// Auth & Dashboard
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Admin
use App\Http\Controllers\admin\RapatController;
use App\Http\Controllers\admin\NotulenController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ArsipAdminController;

// Notulis
use App\Http\Controllers\notulis\AgendaRapatController;
use App\Http\Controllers\notulis\TranskripController;
use App\Http\Controllers\Notulis\NotulisNotulenController;
use App\Http\Controllers\notulis\AboutController;
use App\Http\Controllers\Notulis\ArsipRapatController;

// Pimpinan
use App\Http\Controllers\Pimpinan\AgendaPimpinanController;
use App\Http\Controllers\Pimpinan\NotulenPimpinanController;
use App\Http\Controllers\Pimpinan\ArsipPimpinanController;

// Pegawai
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\Pegawai\PegawaiArsipController;


// =====================
// HALAMAN AWAL
// =====================
Route::get('/', fn() => redirect()->route('login'));


// =====================
// LOGIN & LOGOUT
// =====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// =====================
// ROUTE WAJIB LOGIN (ADMIN + UMUM)
// =====================
Route::middleware('auth')->group(function () {

    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =====================
    // ADMIN - RAPAT
    // =====================
    Route::get('/rapat', [RapatController::class, 'index'])->name('rapat.index');
    Route::get('/rapat/create', [RapatController::class, 'create'])->name('rapat.create');
    Route::post('/rapat', [RapatController::class, 'store'])->name('rapat.store');
    Route::get('/rapat/search', [RapatController::class, 'search'])->name('rapat.search');
    Route::get('/rapat/{id}', [RapatController::class, 'show'])->name('rapat.show');

    // =====================
    // ADMIN - NOTULEN
    // =====================
    Route::get('/notulen', [NotulenController::class, 'index'])->name('notulen.index');
    Route::get('/notulen/search', [NotulenController::class, 'search'])->name('notulen.search');
    Route::get('/notulen/{id}', [NotulenController::class, 'show'])->name('admin.notulen-show');

    // =====================
    // ADMIN - USER
    // =====================
    Route::get('/data-pengguna', [UserController::class, 'index'])->name('users.index');
    Route::get('/data-pengguna/tambah', [UserController::class, 'create'])->name('users.create');
    Route::post('/data-pengguna', [UserController::class, 'store'])->name('users.store');
    Route::get('/data-pengguna/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/data-pengguna/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/data-pengguna/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/data-pengguna/search', [UserController::class, 'search'])->name('users.search');

    // =====================
    // ADMIN - ARSIP
    // =====================
    Route::get('/arsip', [ArsipAdminController::class, 'index'])->name('arsip.index');
    Route::get('/arsip/search', [ArsipAdminController::class, 'search'])->name('arsip.search');
    Route::get('/arsip/{id}/download', [ArsipAdminController::class, 'download'])->name('admin.notulen.download');
    Route::delete('/arsip/{id}', [ArsipAdminController::class, 'destroy'])->name('admin.notulen.destroy');
});


// =====================
// ROUTE NOTULIS
// =====================
Route::middleware(['auth', 'role:notulis'])
    ->prefix('notulis')
    ->name('notulis.')
    ->group(function () {

        // NOTULEN
        Route::get('/notulen', [NotulisNotulenController::class, 'index'])->name('notulen.index');
        Route::get('/notulen/{id}', [NotulisNotulenController::class, 'show'])->name('notulen.show');

        // AGENDA
        Route::get('/agenda', [AgendaRapatController::class, 'index'])->name('agenda.index');
        Route::get('/agenda/{id}', [AgendaRapatController::class, 'show'])->name('agenda.show');

        Route::get('/notulen/buat/{rapat}', [NotulisNotulenController::class, 'create'])
            ->name('notulen.create');

        Route::post('/notulen/buat/{rapat}', [NotulisNotulenController::class, 'store'])
            ->name('notulen.store');

      // TRANSKRIP
        Route::get('/transkrip/buat/{rapat}', [TranskripController::class, 'create'])
            ->name('transkrip.create');          // tampil halaman form

         Route::post('/transkrip', [TranskripController::class, 'store'])
            ->name('transkrip.store'); 

        Route::post('/transkrip/generate', [TranskripController::class, 'generate'])
            ->name('transkrip.generate');       // proses Generate AI
            // POST /notulis/transkrip/generate
        
        Route::post('/transkrip/audio', [TranskripController::class, 'audio'])
            ->name('transkrip.audio');

        Route::get('/test-openai-key', function () {
            $key = env('OPENAI_API_KEY');
            if (!$key) {
                return 'OPENAI_API_KEY belum terbaca';
            }

            return 'OPENAI_API_KEY: '.substr($key, 0, 8).'...'; // cuma 8 karakter pertama
        });

        // ARSIP
        Route::get('/arsip', [ArsipRapatController::class, 'index'])->name('arsip.index');
        Route::get('/arsip/search', [ArsipRapatController::class, 'search'])->name('arsip.search');
        Route::get('/arsip/{id}/download', [ArsipRapatController::class, 'download'])->name('arsip.download');
        Route::delete('/arsip/{id}', [ArsipRapatController::class, 'destroy'])->name('arsip.destroy');
    });


// =====================
// ROUTE PIMPINAN
// =====================
Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->name('pimpinan.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('pimpinan.dashboard'))->name('dashboard');

        // RAPAT
        Route::get('/rapat', [AgendaPimpinanController::class, 'index'])->name('rapat.index');
        Route::get('/rapat/search', [AgendaPimpinanController::class, 'search'])->name('rapat.search');
        Route::get('/rapat/{id}', [AgendaPimpinanController::class, 'show'])->name('rapat.show');
        Route::put('/rapat/{id}/status', [AgendaPimpinanController::class, 'updateStatus'])->name('rapat.updateStatus');

        // NOTULEN
        Route::get('/notulen', [NotulenPimpinanController::class, 'index'])->name('notulen.index');
        Route::get('/notulen/search', [NotulenPimpinanController::class, 'search'])->name('notulen.search');
        Route::get('/notulen/{id}', [NotulenPimpinanController::class, 'show'])->name('notulen.show');
        Route::put('/notulen/{id}', [NotulenPimpinanController::class, 'update'])->name('notulen.update');

        // ARSIP
        Route::get('/arsip', [ArsipPimpinanController::class, 'index'])->name('arsip.index');
        Route::get('/arsip/search', [ArsipPimpinanController::class, 'search'])->name('arsip.search');
        Route::get('/notulen/{id}/download', [NotulenPimpinanController::class, 'download'])->name('notulen.download');

    });


// =====================
// ROUTE PEGAWAI
// =====================
Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {

        Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');

        // JADWAL RAPAT
        Route::get('/jadwal', [PegawaiController::class, 'agendaIndex'])->name('jadwal.index');

        // 🔥 SEARCH YANG BENAR
        Route::get('/jadwal/search', [PegawaiController::class, 'searchAgenda'])
            ->name('jadwal.search');

        Route::get('/jadwal/{id}', [PegawaiController::class, 'agendaShow'])->name('jadwal.show');

        // ARSIP
        Route::get('/arsip', [PegawaiArsipController::class, 'index'])->name('arsip.index');
        Route::get('/arsip/search', [PegawaiArsipController::class, 'search'])->name('arsip.search');
        Route::get('/arsip/{id}/download', [PegawaiArsipController::class, 'download'])->name('arsip.download');
    });

    // =====================
// ROUTE PEGAWAI
// =====================
Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {

        Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');

        Route::get('/jadwal', [PegawaiController::class, 'agendaIndex'])->name('jadwal.index');

        Route::get('/jadwal/search', [PegawaiController::class, 'searchAgenda'])->name('jadwal.search');

        Route::get('/jadwal/{id}', [PegawaiController::class, 'agendaShow'])->name('jadwal.show');

        Route::get('/arsip', [PegawaiArsipController::class, 'index'])->name('arsip.index');

        Route::get('/arsip/search', [PegawaiArsipController::class, 'search'])->name('arsip.search');

        Route::get('/arsip/{id}/download', [PegawaiArsipController::class, 'download'])->name('arsip.download');

       Route::get('/pegawai/rapat/{id}/presensi', [PegawaiController::class, 'scanPresensi'])
            ->middleware(['auth', 'role:pegawai'])
            ->name('pegawai.presensi.scan');
    });


// =============================
// 🔥 PENTING — LETAK DI LUAR SEMUA GROUP
// =============================
Route::get('/test-groq', function () {
    return env('GROQ_API_KEY') 
        ? 'KEY TERBACA: ' . substr(env('GROQ_API_KEY'), 0, 10) . '...' 
        : 'KEY TIDAK TERBACA';
});
