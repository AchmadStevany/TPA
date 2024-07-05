<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\NasabahController;
use App\Models\Nasabah;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Awal
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

//sampah
Route::get('/sampah', [SampahController::class, 'index'])->name('sampah.index');
Route::get('/sampah/create', [SampahController::class, 'create'])->name('sampah.create');
Route::post('/sampah/store', [SampahController::class, 'store'])->name('sampah.store');
Route::get('/sampah/show/{sampah}', [SampahController::class, 'show'])->name('sampah.show');
Route::get('/sampah/edit/{sampah}', [SampahController::class, 'edit'])->name('sampah.edit');
Route::post('/sampah/update/{sampah}', [SampahController::class, 'update'])->name('sampah.update');
Route::get('/sampah/delete/{sampah}', [SampahController::class, 'destroy'])->name('sampah.delete');

//Kategori Sampah
Route::get('/kategorisampah', [KategoriSampahController::class, 'index'])->name('kategori_sampah.index');
Route::get('/kategorisampah/create', [KategoriSampahController::class, 'create'])->name('kategori_sampah.create');
Route::post('/kategorisampah/store', [KategoriSampahController::class, 'store'])->name('kategori_sampah.store');
Route::get('/kategorisampah/show/{kategori}', [KategoriSampahController::class, 'show'])->name('kategori_sampah.show');
Route::get('/kategorisampah/edit/{kategori}', [KategoriSampahController::class, 'edit'])->name('kategori_sampah.edit');
Route::post('/kategorisampah/update/{kategori}', [KategoriSampahController::class, 'update'])->name('kategori_sampah.update');
Route::get('/kategorisampah/delete/{kategori}', [KategoriSampahController::class, 'destroy'])->name('kategori_sampah.delete');

//Nasabah
Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
Route::get('/nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create');
Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
Route::get('/nasabah/show/{nasabah}', [NasabahController::class, 'show'])->name('nasabah.show');
Route::get('/nasabah/edit/{nasabah}', [NasabahController::class, 'edit'])->name('nasabah.edit');
Route::post('/nasabah/update/{nasabah}', [NasabahController::class, 'update'])->name('nasabah.update');
Route::get('/nasabah/delete/{nasabah}', [NasabahController::class, 'destroy'])->name('nasabah.delete');
