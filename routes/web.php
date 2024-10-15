<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landing_page');

Route::prefix('/siswa')->name('siswa.')->group(function(){
    /* route data siswa */
    Route::get('/data/siswa', [DataSiswaController::class, 'index'])->name('data');/* halaman data akun */
    Route::get('/membuat', [DataSiswaController::class, 'create'])->name('tambah');/* halaman create akun */
    Route::post('/menyimpan', [DataSiswaController::class, 'store'])->name('tambah.formulir');/* proses store akun */
    Route::get('/edit/{id}',[DataSiswaController::class, 'edit'])->name('edit');/* halaman edit akun */
    Route::patch('/update/{id}',[DataSiswaController::class, 'update'])->name('ubah.formulir');/* proses update akun */
    Route::delete('/hapus/{id}',[DataSiswaController::class, 'destroy'])->name('destroy');/* proses hapus akun */


    /* route data akun */
    Route::get('/data/akun', [UserController::class, 'index'])->name('data.akun');
    Route::get('/membuat/akun', [UserController::class, 'create'])->name('tambah.akun');
    Route::post('/menyimpan/akun', [UserController::class, 'store'])->name('tambah.akun.formulir');
    Route::get('/edit/akun/{id}',[UserController::class, 'edit'])->name('edit.akun');
    Route::patch('/update/akun/{id}',[UserController::class, 'update'])->name('ubah.akun.formulir');
    Route::delete('/hapus/akun/{id}',[UserController::class, 'destroy'])->name('destroy.akun');
});
