<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nama produk dan kategori yang berpasangan
        $produk = [
            ['nama_produk' => 'Meja Gaming ROG 9402S', 'kategori' => 'Meja'],
            ['nama_produk' => 'Kursi Gaming Keyka 450KJ', 'kategori' => 'Kursi'],
            ['nama_produk' => 'Hardcase POCO X5 AI', 'kategori' => 'Aksesoris'],
            ['nama_produk' => 'Sweater Pria', 'kategori' => 'Pakaian Pria'],
            ['nama_produk' => 'Casio 95S', 'kategori' => 'Jam Tangan'],
            ['nama_produk' => 'Sepatu RGB', 'kategori' => 'Sepatu'],
            ['nama_produk' => 'Lemari Edengan Gambar Elza', 'kategori' => 'Lemari'],
            ['nama_produk' => 'Gamis Wanita', 'kategori' => 'Pakaian Wanita'],
            ['nama_produk' => 'Pons', 'kategori' => 'Make Up'],
            ['nama_produk' => 'Sendal Hiu Viral', 'kategori' => 'Sendal']
        ];

        // Loop untuk memasukkan data ke tabel produks
        foreach ($produk as $data) {
            $kode_barang = Str::upper(Str::random(2)) . '-' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            DB::table('produks')->insert([
                'kode_barang' => $kode_barang,
                'nama_produk' => $data['nama_produk'],
                'jenis_barang' => $data['kategori'],
                'harga_produk' => str_pad(rand(10000, 999999), 6, '0', STR_PAD_LEFT), // Harga antara 10.000 sampai 999.999
            ]);
        }
    }
}
