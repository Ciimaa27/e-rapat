<?php

namespace App\Http\Controllers\notulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notulen;
use App\Models\User;
use App\Models\Rapat;

class NotulisNotulenController extends Controller
{
    // ============================
    // HALAMAN NOTULEN RAPAT (HANYA DIREVIEW & DIREVISI)
    // ============================
    public function index()
    {
        $notulens = Notulen::with('rapat')
                    ->where('status', 'Direview')
                    ->get();

        return view('pages.notulis.notulen.notulen-rapat', compact('notulens'));
    }

    // ============================
    // FORM CREATE NOTULEN
    // ============================
    public function create(Rapat $rapat)
    {

        return view('pages.notulis.notulen.create', compact('rapat'));
    }

    // ============================
    // SIMPAN NOTULEN
    // ============================
    public function store(Request $request, Rapat $rapat)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Notulen::create([
            'rapat_id'    => $rapat->id,
            'judul_rapat' => $rapat->judul_rapat,
            'tanggal'     => $rapat->tanggal,
            'jam'         => $rapat->jam,
            'topik'       => $request->content,
            'status'      => 'Direview',
            'notulis_id'  => auth()->id(),
        ]);

        return redirect()->route('notulis.notulen.index');
    }

    // ============================
    // LIHAT DETAIL
    // ============================
    public function show($id)
    {
        $notulen = Notulen::with('rapat')->findOrFail($id);

        return view('pages.notulis.notulen.notulis-show', compact('notulen'));
    }
}
