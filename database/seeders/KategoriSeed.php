<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Meja','Kursi','Aksesoris','Pakaian Pria'
            ,'Jam Tangan','Sepatu','Lemari','Pakaian Wanita'
            ,'Make Up','Sendal'
        ];
        foreach($kategori as $kategori)
        {
            DB::table('kategoris')->insert([
                'nama_kategori' => $kategori, 
            ]);
        }
    }
}
