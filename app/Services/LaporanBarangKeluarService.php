<?php

namespace App\Services;

use App\Models\Stock;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangKeluarExport;
use Illuminate\Support\Facades\DB;
class LaporanBarangKeluarService
{
    public function renderBarangKeluar()
    {
        $stok = Stock::with('produk')->where('stok_keluar','!=',0)->orderBy('created_at','DESC')->get();
        $data = [
            'kode_barang' => [],
            'nama_produk' => [],
            'jenis_barang' => [],
            'stok_keluar' => [],
            'tanggal' => []
        ];

        foreach($stok as $st)
        {
            $data['kode_barang'][] = $st->produk->kode_barang ?? 'N/A';
            $data['nama_produk'][] = $st->produk->nama_produk ?? 'N/A';
            $data['jenis_barang'][] = $st->produk->jenis_barang ?? 'N/A';
            $data['stok_keluar'][] = $st->stok_keluar;
            $data['tanggal'][] = $st->tanggal;
        }

        return Excel::download(new BarangKeluarExport($data), 'Laporan Barang Keluar-'.Carbon::now()->format("Y-m-d").'.xlsx');
    }
}
