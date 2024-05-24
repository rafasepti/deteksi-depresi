<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pasien.index');
})->name('index');

Route::middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('index.admin');

    Route::get('/data-admin', [AdminController::class, 'index'])->name('admin.data-admin');
    Route::get('/data-admin/list', [AdminController::class, 'dataTable'])->name('admin.data-admin.list');
    Route::get('/data-admin/tambah', [AdminController::class, 'create'])->name('admin.data-admin.create');
    Route::post('/data-admin/store', [AdminController::class, 'store'])->name('admin.data-admin.store');
    Route::get('/data-admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.data-admin.edit');
    Route::post('/data-admin/update', [AdminController::class, 'update'])->name('admin.data-admin.update');
    Route::get('/data-admin/hapus/{id}', [AdminController::class, 'destroy']);

    Route::get('/gejala', [GejalaController::class, 'index'])->name('admin.gejala');
    Route::get('/gejala/list', [GejalaController::class, 'dataTable'])->name('admin.gejala.list');
    Route::get('/gejala/tambah', [GejalaController::class, 'create'])->name('admin.gejala.create');
    Route::post('/gejala/store', [GejalaController::class, 'store'])->name('admin.gejala.store');
    Route::get('/gejala/edit/{id}', [GejalaController::class, 'edit'])->name('admin.gejala.edit');
    Route::post('/gejala/update', [GejalaController::class, 'update'])->name('admin.gejala.update');
    Route::get('/gejala/hapus/{id}', [GejalaController::class, 'destroy']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
