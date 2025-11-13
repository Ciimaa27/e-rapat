<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotulenController extends Controller
{
    public function index()
    {
        // sementara pakai dummy data biar kelihatan di tabel
        $notulens = [
            (object)[
                'id'     => 1,
                'title'  => 'Persiapan Uji Coba Sistem e-Notulen',
                'date'   => '21-02-2030',
                'time'   => '09:00',
                'agenda' => 'Lorem ipsum dolor sit amet, consectetur adipisi elit...',
                'status' => 'Direview',
            ],
            (object)[
                'id'     => 2,
                'title'  => 'Evaluasi Pelaksanaan Kegiatan Triwulan III Tahun 2025',
                'date'   => '18-02-2030',
                'time'   => '09:00',
                'agenda' => 'Lorem ipsum dolor sit amet, consectetur adipisi elit...',
                'status' => 'Selesai',
            ],
        ];

        return view('pages.residents.notulen', compact('notulens'));
    }

    public function show($id)
    {
        // nanti bisa ambil dari DB, sekarang dummy dulu
        return view('pages.residents.notulen-show', compact('id'));
    }
}
