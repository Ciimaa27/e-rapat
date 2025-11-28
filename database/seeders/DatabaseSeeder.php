<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jangan pakai factory Test User lagi
        // User::factory()->create([...]);

        // panggil seeder yang sudah kamu buat
        $this->call([
            UserSeeder::class,
            RapatSeeder::class,
            NotulenSeeder::class,
        ]);
    }
}
