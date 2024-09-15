<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReturPembelianController;
use App\Http\Controllers\StockKeluarController;
use Carbon\Carbon;
use App\Models\Stock;
use App\Exports\StockExport;
use Maatwebsite\Excel\Facades\Excel;
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
Route::controller(AuthController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','login');
    Route::get('/logout','index')->name('logout');
});
Route::middleware('auth')->group(function(){
    Route::middleware(['role:1,2'])->group(function () {
        Route::controller(ReturController::class)->group(function(){
            Route::get('/dataretur','index')->name('retur.index');
            Route::post('/dataretur','store')->name('retur.store');
            Route::post('/updatedataretur','update')->name('retur.update');
            Route::get('/laporan-stok','downloadLaporan')->name('retur.getLaporan');
            Route::get('/hapus-dataretur/{id}','destroy')->name('retur.destroy');
        });
    });
    Route::middleware(['role:1,3'])->group(function () {
        Route::get('/dataretur/{id}',[ReturController::class,'kirimBarang'])->name('retur.kirim');
        Route::controller(ReturPembelianController::class)->group(function(){
            Route::get('/barang-rusak','index')->name('returpembelian.index');
            Route::post('/barang-rusak','store')->name('returpembelian.store');
            Route::post('/update-retur-pembelian','update')->name('returpembelian.update');
            Route::get('/laporan-retur-pembelian','cetakLaporanRetur')->name('returpembelian.laporanRetur');
            Route::get('/data-barang-retur','returShow')->name('returpembelian.returShow');
            Route::get('/hapus-dataretur-pembelian/{id}','destroy')->name('returpembelian.destroy');
        });
    });
    
    Route::controller(StockKeluarController::class)->group(function(){
        Route::get('/laporan-barang-keluar','index')->name('laporan.keluar');
        Route::get('/laporan-barang-masuk','index')->name('laporan.masuk');
    });

});
Route::get('/', function () {
    return view('login');
    // return view('welcome');
});
