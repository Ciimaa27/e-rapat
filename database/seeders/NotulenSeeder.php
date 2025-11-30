<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notulen;

class NotulenSeeder extends Seeder
{
    public function run(): void
    {
        Notulen::create([
            'rapat_id' => 1,
            'notulis_id' => 2,
            'judul_rapat' => 'Persiapan Uji Coba Sistem e-Notulen',
            'tanggal' => '2030-02-21',
            'jam' => '09:00', // <-- TAMBAHKAN INI
            'topik' => 'Ringkasan teknis uji coba sistem dan pembagian tugas.',
            'status' => 'Direview',
        ]);

        Notulen::create([
            'rapat_id' => 2,
            'notulis_id' => 2,
            'judul_rapat' => 'Evaluasi Program Publikasi',
            'tanggal' => '2030-02-20',
            'jam' => '10:30',
            'topik' => 'Evaluasi hasil publikasi Q1 dan perencanaan Q2.',
            'status' => 'Direview',  // <-- UBAH INI
        ]);


        Notulen::create([
            'rapat_id' => 3,
            'notulis_id' => 2,
            'judul_rapat' => 'Persiapan Acara Pemerintah Daerah',
            'tanggal' => '2030-02-18',
            'jam' => '13:00', // <-- TAMBAHKAN INI
            'topik' => 'Pembahasan teknis acara dan pembagian penanggung jawab.',
            'status' => 'Direview',
        ]);
    }
}
