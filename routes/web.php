<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardNasabahController;
use App\Http\Controllers\SampahNasabahController;
use App\Http\Controllers\TransaksiController;

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
//Login
Route::get('/',[LoginController::class,'index']);
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login/authenticate',[LoginController::class,'authenticate'])->name('login.authenticate');
Route::get('/register',[RegisterController::class,'index'])->name('register.index')->middleware('guest');
Route::post('/register/store',[RegisterController::class,'store'])->name('register.store');

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Awal
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard2022', [DashboardController::class, 'index2'])->middleware('auth');

//sampah
Route::get('/sampah', [SampahController::class, 'index'])->name('sampah.index')->middleware('auth');
Route::get('/sampah/create', [SampahController::class, 'create'])->name('sampah.create')->middleware('auth');
Route::post('/sampah/store', [SampahController::class, 'store'])->name('sampah.store');
Route::get('/sampah/show/{sampah}', [SampahController::class, 'show'])->name('sampah.show');
Route::get('/sampah/edit/{sampah}', [SampahController::class, 'edit'])->name('sampah.edit');
Route::post('/sampah/update/{sampah}', [SampahController::class, 'update'])->name('sampah.update');
Route::get('/sampah/delete/{sampah}', [SampahController::class, 'destroy'])->name('sampah.delete');

//sampah-nasabah
Route::get('/sampah-nasabah', [SampahNasabahController::class, 'index'])->name('sampah-nasabah.index')->middleware('auth');

//Kategori Sampah
Route::get('/kategorisampah', [KategoriSampahController::class, 'index'])->name('kategori_sampah.index')->middleware('auth');
Route::get('/kategorisampah/create', [KategoriSampahController::class, 'create'])->name('kategori_sampah.create')->middleware('auth');
Route::post('/kategorisampah/store', [KategoriSampahController::class, 'store'])->name('kategori_sampah.store');
Route::get('/kategorisampah/show/{kategori}', [KategoriSampahController::class, 'show'])->name('kategori_sampah.show');
Route::get('/kategorisampah/edit/{kategori}', [KategoriSampahController::class, 'edit'])->name('kategori_sampah.edit');
Route::post('/kategorisampah/update/{kategori}', [KategoriSampahController::class, 'update'])->name('kategori_sampah.update');
Route::get('/kategorisampah/delete/{kategori}', [KategoriSampahController::class, 'destroy'])->name('kategori_sampah.delete');

//Nasabah
Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index')->middleware('auth');
Route::get('/nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create')->middleware('auth');
Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
Route::get('/nasabah/show/{nasabah}', [NasabahController::class, 'show'])->name('nasabah.show');
Route::get('/nasabah/edit/{nasabah}', [NasabahController::class, 'edit'])->name('nasabah.edit');
Route::post('/nasabah/update/{nasabah}', [NasabahController::class, 'update'])->name('nasabah.update');
Route::get('/nasabah/delete/{nasabah}', [NasabahController::class, 'destroy'])->name('nasabah.delete');

//Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.create')->middleware('auth');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store')->middleware('auth');
