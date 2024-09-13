<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class LaporanReturPembelian implements FromArray, WithHeadings
{
  protected $dataArray;
  
  public function __construct(array $dataArray)
  {
    $this->data = $dataArray;
  }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [
            ['Nota Retur Pembelian' => $this->data['nota'],
            'Kode Barang' => $this->data['kode_barang'],
            'Nama Barang' => $this->data['nama_produk'],
            'Jenis Barang' => $this->data['jenis_barang'],
            'Jumlah Barang' => $this->data['jumlah_barang'],
            'Kondisi Barang' => $this->data['kondisi'],
            'Tanggal Barang Datang' => $this->data['tgl_datang'],
            'Alasan Retur' => $this->data['alasan'],
            'Tindakan' => $this->data['tindakan'],]
        ];
    }
    
    public function headings(): array
    {
      return ['Nota Retur Pembelian', 'Kode Barang', 'Nama Barang', 'Jenis Barang','Jumlah Barang','Kondisi Barang','Tanggal Barang Datang','Alasan Retur','Tindakan'];
    }

  
}
