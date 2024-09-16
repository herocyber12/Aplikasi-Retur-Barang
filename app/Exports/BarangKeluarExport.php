<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangKeluarExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
    public function __construct($data)
    {  
        $this->data = $data;
    }
    public function array(): array
    {
        $output = [];
        foreach($this->data['stok_keluar'] as $index => $item)
        {
            $output[] = [
                'Kode Barang' => $this->data['kode_barang'][$index],
                'Nama Produk' => $this->data['nama_produk'][$index],
                'Jenis Barang' => $this->data['jenis_barang'][$index],
                'Stok Keluar' => $this->data['stok_keluar'][$index],
                'Tanggal Barang Keluar' => $this->data['tanggal'][$index],
            ];
        }
        return $output;
    }

    public function headings():array
    {
        return ['Kode Barang', 'Nama Produk', 'Jenis Barang', 'Stok Keluar','Tanggal Barang Keluar'];
    }
}
