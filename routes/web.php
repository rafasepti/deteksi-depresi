<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
