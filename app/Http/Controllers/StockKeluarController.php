<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockKeluarController extends Controller
{
    public function index()
    {
        $stock = Stock::with(['retur', 'produk'])->whereHas('retur', function($query) {
            if (request()->routeIs('laporan.masuk')) {
                $query->where('kondisi_barang', 'Baik');
            } else {
                $query->where(function($q) {
                    $q->where('kondisi_barang', 'Rusak')
                    ->orWhere('kondisi_barang', 'Rusak(Sudah Diproses)');
                });
            }
        })->orderBy('created_at','DESC')->paginate(10);
        
        return view('stock',compact('stock'));
    }

    public function stok_semua()
    {
        $stock = Stock::with(['retur', 'produk'])->orderBy('created_at','DESC')->paginate(10);
        return view('stock_barang',compact('stock'));

    }
}
