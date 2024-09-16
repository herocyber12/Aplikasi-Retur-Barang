<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProduksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('produks')->insert([
                'kode_barang' => $faker->unique()->word,
                'nama_produk' => $faker->word,
                'jenis_barang' => $faker->word,
                'harga_produk' => $faker->numberBetween(10000, 100000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
