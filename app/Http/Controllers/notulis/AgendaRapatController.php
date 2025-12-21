<?php

namespace App\Http\Controllers\Notulis;

use App\Http\Controllers\Controller;
use App\Models\Rapat;
use Illuminate\Support\Facades\Auth;

class AgendaRapatController extends Controller
{
    public function index()
    {
        $rapats = Rapat::where('notulis_id', Auth::id())
            ->whereIn('status', ['Terjadwal']) // 🔥 STATUS DISAMAKAN
            ->orderBy('tanggal', 'asc')
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
