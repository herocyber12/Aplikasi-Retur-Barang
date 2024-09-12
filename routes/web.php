<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReturController;
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

Route::controller(ReturController::class)->group(function(){
    Route::get('/dataretur','index')->name('retur.index');
    Route::post('/dataretur','store')->name('retur.store');
    Route::post('/updatedataretur','update')->name('retur.update');
    Route::get('/laporan-stok','downloadLaporan')->name('retur.getLaporan');
    Route::get('/hapus-dataretur/{id}','destroy')->name('retur.destroy');
});
Route::get('/', function () {
    return view('login');
    // return view('welcome');
});
