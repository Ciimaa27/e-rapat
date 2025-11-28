<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Ratih Addanenggar',
            'email' => 'admin@notulen1',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        // Notulis
        User::create([
            'name' => 'Naimatul Aufa ',
            'email' => 'notulis@notulen1',
            'password' => bcrypt('123'),
            'role' => 'notulis',
        ]);

        // Pimpinan
        User::create([
            'name' => 'Eka Rahayu Normasari',
            'email' => 'pimpinan@notulen',
            'password' => bcrypt('123'),
            'role' => 'pimpinan',
        ]);

        // Pegawai
        User::create([
            'name' => 'Liana Elsami',
            'email' => 'pegawai@notulen1',
            'password' => bcrypt('123'),
            'role' => 'pegawai',
        ]);
    }
}
