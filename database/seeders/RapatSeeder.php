<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rapat;

class RapatSeeder extends Seeder
{
    public function run(): void
    {
        Rapat::create([
            'judul_rapat' => 'Persiapan Uji Coba Sistem e-Notulen',
            'tanggal' => '2030-02-21',
            'jam' => '09:00',
            'ruangan' => 'Diskusi persiapan dan teknis pelaksanaan uji coba sistem.',
            'prioritas' => 'Penting',
            'status' => 'Terjadwal',
            'dibuat_oleh' => 1,
        ]);

        Rapat::create([
            'judul_rapat' => 'Evaluasi Program Publikasi',
            'tanggal' => '2030-02-20',
            'jam' => '10:30',
            'ruangan' => 'Evaluasi hasil publikasi Q1 dan rencana Q2.',
            'prioritas' => 'Darurat',
            'status' => 'Terjadwal',
            'dibuat_oleh' => 1,
        ]);

        Rapat::create([
            'judul_rapat' => 'Persiapan Acara Pemerintah Daerah',
            'tanggal' => '2030-02-18',
            'jam' => '13:00',
            'ruangan' => 'Pembahasan teknis dan penanggung jawab kegiatan.',
            'prioritas' => 'Normal',
            'status' => 'Terjadwal',
            'dibuat_oleh' => 1,
        ]);
    }
}
