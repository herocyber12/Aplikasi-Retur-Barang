<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RetursTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $produks = DB::table('produks')->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            DB::table('returs')->insert([
                'produks_id' => $faker->randomElement($produks),
                'supplier' => $faker->company,
                'no_hp_supplier' => $faker->phoneNumber,
                'alamat_supplier' => $faker->address,
                'tgl_masuk_gudang' => $faker->date(),
                'jumlah_barang' => $faker->numberBetween(1, 100),
                'kondisi_barang' => $faker->randomElement(['Baik', 'Rusak', 'Rusak(Sudah Diproses)']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
