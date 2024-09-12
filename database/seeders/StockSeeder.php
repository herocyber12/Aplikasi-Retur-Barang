<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = Produk::all();

        foreach($produk as $produk)
        {
            DB::table('stocks')->insert([
                'produk_id' => $produk->id,
                'stok' => mt_rand(000,499),
                'stok_masuk' => mt_rand(00,49),
                'stok_keluar' => mt_rand(00,49),
                'tanggal' => Carbon::now()->format('Y-m-d')
            ]);
        }
    }
}
