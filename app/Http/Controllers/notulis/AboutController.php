<?php

namespace App\Http\Controllers\notulis;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $team = [
            [
                'name'  => 'Nama Developer 1',
                'role'  => 'Frontend Developer',
                'desc'  => 'Bertanggung jawab pada tampilan antarmuka E-Notulen.',
            ],
            [
                'name'  => 'Nama Developer 2',
                'role'  => 'Backend Developer',
                'desc'  => 'Mengembangkan API dan logika bisnis aplikasi.',
            ],
            [
                'name'  => 'Nama Developer 3',
                'role'  => 'UI/UX Designer',
                'desc'  => 'Merancang pengalaman pengguna yang sederhana dan nyaman.',
            ],
        ];

        return view('pages.notulis.notulen.about', compact('team'));
    }
}
