<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReturPembeliansTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $returs = DB::table('returs')->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            DB::table('retur_pembelians')->insert([
                'nota_retur_pembelian' => $faker->word,
                'retur_id' => $faker->randomElement($returs),
                'alasan_retur' => $faker->sentence,
                'tindakan' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
