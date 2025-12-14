<?php

namespace App\Http\Controllers\notulis;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
{
    $team = [
        [
            'name' => 'Radita Nabila Shofa',
            'role' => 'UI/UX Designer',
            'desc' => 'Bertanggung jawab dalam merancang tampilan antarmuka dan pengalaman pengguna pada sistem E-Notulen.',
            'photo' => 'foto/nabila.jpg'
        ],
        [
            'name' => 'Naila Hafidhah',
            'role' => 'Front-End Developer',
            'desc' => 'Mengembangkan dan mengimplementasikan desain antarmuka menjadi halaman web yang interaktif dan responsif.',
            'photo' => 'foto/naila.jpg'
        ],
        [
            'name' => 'Ismatul Hawa',
            'role' => 'Back-End Developer',
            'desc' => 'Membangun logika server, pengelolaan database, serta integrasi sistem pada aplikasi E-Notulen.',
            'photo' => 'foto/isma.jpg'
        ],
    ];

    return view('pages.notulis.notulen.about', compact('team'));
}
}
