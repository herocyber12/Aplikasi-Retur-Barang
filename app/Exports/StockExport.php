<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromArray,WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */

    protected $dataArray;

    public function __construct(array $dataArray)
    {
        $this->data = $dataArray;
    }

    public function array():array
    {
        $output = [];
        foreach($this->data['stok'] as $index => $item){
            $output[] = [
                'Kode Barang' => $this->data['kode_barang'][$index],
                'Nama Barang' => $this->data['nama_produk'][$index],
                'Jenis Barang' => $this->data['jenis_produk'][$index],
                'Stok' => $this->data['stok'][$index],
                'Stok Masuk' => $this->data['stok_masuk'][$index],
                'Stok Keluar' => $this->data['stok_keluar'][$index],
                'Bulan' => $this->data['bulan'][$index],
                'Tanggal Input Terbaru' => $this->data['tanggal_terbaru'][$index],
            ];

        };

        return $output;
    }

    public function headings(): array
    {
        return ['Kode Barang','Nama Barang','Jenis Barang','Stok','Stok Masuk','Stok Keluar','Bulan','Tanggal Input Terbaru'];
    }
}
