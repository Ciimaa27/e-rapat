<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notulen;

class NotulenSeeder extends Seeder
{
    public function run(): void
    {
        Notulen::create([
            'rapat_id' => 2,
            'notulis_id' => 2,
            'judul_rapat' => 'Persiapan Uji Coba Sistem e-Notulen',
            'tanggal' => '2030-02-21',
            'topik' => 'Ringkasan teknis uji coba sistem dan pembagian tugas.',
            'status' => 'Direview',
        ]);

        Notulen::create([
            'rapat_id' => 3,
            'notulis_id' => 2,
            'judul_rapat' => 'Evaluasi Program Publikasi',
            'tanggal' => '2030-02-20',
            'topik' => 'Evaluasi hasil publikasi Q1 dan perencanaan Q2.',
            'status' => 'Disetujui',
        ]);

        Notulen::create([
            'rapat_id' => 4,
            'notulis_id' => 2,
            'judul_rapat' => 'Persiapan Acara Pemerintah Daerah',
            'tanggal' => '2030-02-18',
            'topik' => 'Pembahasan teknis acara dan pembagian penanggung jawab.',
            'status' => 'Direview',
        ]);
    }
}
