<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentsController;

use App\Http\Controllers\RapatController;
use App\Http\Controllers\NotulenController;

use App\Http\Controllers\UserController;

// halaman utama (kalau mau langsung ke dashboard bisa diubah jadi redirect)
Route::get('/', function () {
    return view('layouts.app-tailwind');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// DAFTAR NOTULEN
Route::get('/notulen', [NotulenController::class, 'index'])
    ->name('notulen.index');

// DETAIL NOTULEN
Route::get('/notulen/{id}', [NotulenController::class, 'show'])
    ->name('notulen.show');

// DATA PENGGUNA
Route::get('/data-pengguna', [UserController::class, 'index'])
    ->name('users.index');
Route::get('/data-pengguna/{id}/edit', [UserController::class, 'edit'])
    ->name('users.edit');
Route::delete('/data-pengguna/{id}', [UserController::class, 'destroy'])
    ->name('users.destroy');

Route::get('/data-pengguna', [UserController::class, 'index'])
    ->name('users.index');
Route::get('/data-pengguna/tambah', [UserController::class, 'create'])
    ->name('users.create');
Route::post('/data-pengguna', [UserController::class, 'store'])
    ->name('users.store');




// Residents CRUD
Route::get('/resident',            [ResidentsController::class, 'index'])->name('residents.index');
Route::get('/resident/create',     [ResidentsController::class, 'create'])->name('residents.create');
Route::post('/resident',           [ResidentsController::class, 'store'])->name('residents.store');
Route::get('/resident/{id}/edit',  [ResidentsController::class, 'edit'])->name('residents.edit');
Route::put('/resident/{id}',       [ResidentsController::class, 'update'])->name('residents.update');
Route::delete('/resident/{id}',    [ResidentsController::class, 'destroy'])->name('residents.destroy');
