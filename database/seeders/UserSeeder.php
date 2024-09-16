<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::pluck('id')->toArray();
        $akun = [
            ['username' => 'admin123', 'email' => 'admin123@gmail.com', 'password' => Hash::make('12341234')],
            ['username' => 'gudang123', 'email' => 'gudang123@gmail.com', 'password' => Hash::make('12341234')],
            ['username' => 'pengiriman123', 'email' => 'pengiriman123@gmail.com', 'password' => Hash::make('12341234')],
        ];
        
        // Pastikan jumlah akun sama dengan jumlah role
        foreach($akun as $index => $data) {
            DB::table('users')->insert([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'id_role' => $roles[$index], // Mengambil id_role dari array roles berdasarkan indeks
            ]);
        }
    }
}
