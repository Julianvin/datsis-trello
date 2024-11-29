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

Route::middleware('Guest')->group(function () {
    Route::get('/', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login/process', [UserController::class, 'loginAuth'])->name('login.process');
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register/process', [UserController::class, 'makeAcc'])->name('register.process');
});


Route::middleware('Login')->group(function () {

    Route::get('/logout', [UserController::class, 'logOut'])->name('logout');
    /* Route untuk siswa */
    Route::middleware(['Siswa'])->prefix('/siswa')->group(function () {
        Route::get('/halaman', [LandingPageController::class, 'userLandingPage'])->name('landing_page_siswa');
        // Rute lainnya yang hanya bisa diakses oleh siswa
    });

    /* Route untuk admin */
    Route::middleware(['Admin'])->prefix('/admin')->group(function () {
        /* route untuk login admin */
        Route::get('/halaman', [LandingPageController::class, 'adminLandingPage'])->name('landing_page_admin');
        Route::prefix('/siswa')->name('siswa.')->group(function () {

            /* route CRUD data siswa */
            Route::get('/data/siswa', [DataSiswaController::class, 'index'])->name('data');
            Route::get('/membuat', [DataSiswaController::class, 'create'])->name('tambah');
            Route::post('/menyimpan', [DataSiswaController::class, 'store'])->name('tambah.formulir');
            Route::get('/edit/{id}', [DataSiswaController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [DataSiswaController::class, 'update'])->name('ubah.formulir');
            Route::delete('/hapus/{id}', [DataSiswaController::class, 'destroy'])->name('destroy');
            Route::get('/siswa/export-siswa-pdf/{id}', [DataSiswaController::class, 'exportPDF'])->name('export-siswa-pdf');
            Route::get('/export/excel/dataSiswa', [DataSiswaController::class, 'exportExcelDataSiswa'])->name('export.excel.dataSiswa');

            /* route CRUD data akun */
            Route::get('/data/akun', [UserController::class, 'index'])->name('data.akun');
            Route::get('/membuat/akun', [UserController::class, 'create'])->name('tambah.akun');
            Route::post('/menyimpan/akun', [UserController::class, 'store'])->name('tambah.akun.formulir');
            Route::get('/edit/akun/{id}', [UserController::class, 'edit'])->name('edit.akun');
            Route::patch('/update/akun/{id}', [UserController::class, 'update'])->name('ubah.akun.formulir');
            Route::get('/export/excel/dataAkun', [UserController::class, 'exportExcelUsers'])->name('export.excel.dataAkun');
            // Route::delete('/hapus/akun/{id}', [UserController::class, 'destroy'])->name('destroy.akun');
        });
    });
});

/* route error */
Route::get('/error', [UserController::class, 'error'])->name('error');
Route::fallback(function () {
    return redirect()->route('error');
});
