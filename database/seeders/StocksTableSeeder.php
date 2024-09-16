<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StocksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $produks = DB::table('produks')->pluck('id');
        $returs = DB::table('returs')->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            DB::table('stocks')->insert([
                'produk_id' => $faker->randomElement($produks),
                'retur_id' => $faker->optional()->randomElement($returs),
                'stok' => $faker->numberBetween(0, 100),
                'stok_masuk' => $faker->numberBetween(0, 50),
                'stok_keluar' => $faker->numberBetween(0, 50),
                'tanggal' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
