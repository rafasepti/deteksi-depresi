<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepresiController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PertanyaanDiagnosaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TesController;
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

    Route::get('/gangguan', [DepresiController::class, 'index'])->name('admin.depresi');
    Route::get('/gangguan/list', [DepresiController::class, 'dataTable'])->name('admin.depresi.list');
    Route::get('/gangguan/tambah', [DepresiController::class, 'create'])->name('admin.depresi.create');
    Route::post('/gangguan/store', [DepresiController::class, 'store'])->name('admin.depresi.store');
    Route::get('/gangguan/gejala/{id}', [DepresiController::class, 'gejala'])->name('admin.depresi.gejala');
    Route::post('/gangguan/gejalaStore', [DepresiController::class, 'Gejalastore'])->name('admin.depresi.gejala-store');
    Route::get('/gangguan/edit/{id}', [DepresiController::class, 'edit'])->name('admin.depresi.edit');
    Route::post('/gangguan/update', [DepresiController::class, 'update'])->name('admin.depresi.update');
    Route::get('/gangguan/hapus/{id}', [DepresiController::class, 'destroy']);

    Route::get('/pertanyaan', [PertanyaanDiagnosaController::class, 'index'])->name('admin.pertanyaan');
    Route::get('/pertanyaan/list', [PertanyaanDiagnosaController::class, 'dataTable'])->name('admin.pertanyaan.list');
    Route::get('/pertanyaan/tambah', [PertanyaanDiagnosaController::class, 'create'])->name('admin.pertanyaan.create');
    Route::post('/pertanyaan/store', [PertanyaanDiagnosaController::class, 'store'])->name('admin.pertanyaan.store');
    Route::get('/pertanyaan/edit/{id}', [PertanyaanDiagnosaController::class, 'edit'])->name('admin.pertanyaan.edit');
    Route::post('/pertanyaan/update', [PertanyaanDiagnosaController::class, 'update'])->name('admin.pertanyaan.update');
    Route::get('/pertanyaan/hapus/{id}', [PertanyaanDiagnosaController::class, 'destroy']);
});

Route::middleware('auth', 'checkRole:pasien')->group(function () {
    Route::get('/diagnosa-depresi', [DiagnosaController::class, 'index'])->name('pasien.diagnosa');
    Route::post('/diagnosa-depresi', [DiagnosaController::class, 'storeAnswers'])->name('pasien.diagnosa.session');
    Route::get('/hasil-diagnosa', [DiagnosaController::class, 'showResult'])->name('pasien.diagnosa.result');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
