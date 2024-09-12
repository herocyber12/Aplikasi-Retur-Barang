<?php

namespace App\Services;

use App\Models\Stock;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;
use Illuminate\Support\Facades\DB;

class LaporanStokService
{
    public function generateStockReport()
    {
        // Set tanggal saat ini
        $tanggal_sekarang = Carbon::now();
        $bulan_sekarang = $tanggal_sekarang->month;
        $tahun_sekarang = $tanggal_sekarang->year;
        $nama_bulan_sekarang = $tanggal_sekarang->translatedFormat('F');

        // Ambil data stok berdasarkan produk
        $data = Stock::with('produk')
            ->select('produk_id', 
            DB::raw('SUM(stok_masuk) as total_stok_masuk'),
            DB::raw('SUM(stok_keluar) as total_stok_keluar')
            )
            ->whereMonth("tanggal", $bulan_sekarang)
            ->whereYear("tanggal", $tahun_sekarang)
            ->addSelect(DB::raw('(SELECT stok 
                                FROM stocks s2 
                                WHERE s2.produk_id = stocks.produk_id 
                                ORDER BY s2.tanggal ASC, s2.created_at DESC 
                                LIMIT 1) as stok_terbaru'))
            ->addSelect(DB::raw('(SELECT tanggal 
                                FROM stocks s2 
                                WHERE s2.produk_id = stocks.produk_id 
                                ORDER BY s2.tanggal ASC, s2.created_at DESC 
                                LIMIT 1) as tanggal_terbaru'))
            ->groupBy('produk_id')
            ->get();

        // Siapkan array data untuk di-export
        $dataArray = [
            'kode_barang' => [],
            'nama_produk' => [],
            'jenis_produk' => [],
            'stok' => [],
            'stok_masuk' => [],
            'stok_keluar' => [],
            'bulan' => [],
            'tanggal_terbaru' => []
        ];

        // Loop data untuk memasukkan ke array
        foreach($data as $item)
        {
            $dataArray['kode_barang'][] = $item->produk->kode_barang ?? 'Barang Tidak Ditemukan';
            $dataArray['nama_produk'][] = $item->produk->nama_produk ?? 'Barang Tidak Ditemukan';
            $dataArray['jenis_produk'][] = $item->produk->jenis_barang ?? 'Kategori Tidak Ditemukan';
            $dataArray['stok'][] = $item->stok_terbaru;
            $dataArray['stok_masuk'][] = $item->total_stok_masuk;
            $dataArray['stok_keluar'][] = $item->total_stok_keluar;
            $dataArray['bulan'][] = $nama_bulan_sekarang;
            $dataArray['tanggal_terbaru'][] = $item->tanggal_terbaru;
        }

        // Download file Excel dengan data laporan stok
        return Excel::download(new StockExport($dataArray), 'Laporan_Stok-'.$tanggal_sekarang->format('Y-m-d').'.xlsx');
    }
}
