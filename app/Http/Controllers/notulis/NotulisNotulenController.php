<?php

namespace App\Http\Controllers\notulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notulen;
use App\Models\User;

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
    public function create()
    {
        $notulisList = User::where('role', 'notulis')->get();

        return view('pages.notulis.notulen.create', compact('notulisList'));
    }

    // ============================
    // SIMPAN NOTULEN
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'date'    => 'required|date',
            'jam'     => 'required',
            'content' => 'required',
            'file'    => 'nullable|mimes:pdf|max:2048', // <--- VALIDASI FILE
        ]);

        // SIMPAN FILE
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('notulens'); 
        }

        // SIMPAN DATA NOTULEN
        Notulen::create([
            'judul_rapat' => $request->title,
            'tanggal'     => $request->date,
            'jam'         => $request->jam,
            'topik'       => $request->content,
            'status'      => 'Direview',
            'notulis_id'  => auth()->id(),
            'file'        => $filePath,  // <--- SIMPAN PATH
        ]);

        return redirect()->route('notulis.notulen.index')
                        ->with('success', 'Notulen berhasil diajukan!');
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
