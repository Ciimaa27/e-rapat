<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapatController extends Controller
{
    // daftar rapat
    public function index()
    {
        // nanti kalau sudah ada model, bisa kirim data:
        // $meetings = Rapat::all();
        // return view('pages.rapat.index', compact('meetings'));

        return view('pages.rapat.index'); // SESUAIKAN dengan nama file blade-mu
    }

    // form buat rapat
    public function create()
    {
        return view('pages.rapat.create'); // SESUAIKAN juga dengan view form
    }
}
