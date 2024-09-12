<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class LaporanReturPembelian implements FromArray, WithHeadings
{
  protected $dataArray
  
  public function __construct()
  {
    $this->data = $dataArray;
  }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $output = [];
        
    }
    
    public function headings(): array
    {
      return ['Nota Retur Pembelian', 'Kode Barang', 'Nama Barang', 'Jenis Barang','Jumlah Barang','Kondisi Barang','Tanggal Barang Datang','Alasan Retur','Tindakan']
    }

  
}
