<?php

namespace App\Http\Controllers\notulis;

use App\Http\Controllers\Controller;
use App\Models\Rapat;
use Illuminate\Support\Facades\Auth;

class AgendaRapatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua rapat yang ditugaskan ke notulis yang sedang login
        $rapats = Rapat::where('notulis_id', $user->id)
    ->whereDoesntHave('notulen', function($query){
        $query->where('status', 'Direview')->orWhere('status', 'Disetujui');
    })
    ->orderBy('tanggal', 'desc')
    ->orderBy('jam', 'asc')
    ->get();

        return view('pages.notulis.notulen.index', compact('rapats'));
    }

    public function show($id)
    {
        $rapat = Rapat::findOrFail($id);

        return view('pages.notulis.notulen.detail-notulis', compact('rapat'));
    }

}
