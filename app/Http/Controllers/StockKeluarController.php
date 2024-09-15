<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockKeluarController extends Controller
{
    public function index()
    {
        $stock = Stock::with(['retur','produk'])->whereHas('retur',function($query){
        request()->routeIs('laporan.masuk') ? $query->where('kondisi_barang', 'Baik') : $query->where('kondisi_barang', 'Rusak')->orWhere('kondisi_barang','Rusak(Sudah Diproses)');
        })->paginate(10);

        return view('stock',compact('stock'));
    }
}
