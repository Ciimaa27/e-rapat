<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rapat;   
use App\Models\User;

class RapatController extends Controller
{
    /**
     * LIST RAPAT (ADMIN)
     * Sudah siap untuk realtime search (AJAX)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rapats = Rapat::query()
            ->when($search, function ($q) use ($search) {
                $q->where('judul_rapat', 'like', "%{$search}%");
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.admin.rapat.index', compact('rapats', 'search'));
    }


    /**
     * REALTIME SEARCH — return JSON
     */
    public function search(Request $request)
    {
        $keyword = $request->q;

        $rapats = Rapat::where('judul_rapat', 'like', "%{$keyword}%")
                        ->orderBy('tanggal', 'desc')
                        ->get();

        return response()->json($rapats);
    }


    /**
     * CREATE RAPAT
     */
    public function create()
    {
        $notulisList = User::where('role', 'notulis')->orderBy('name')->get();
        $pegawaiList = User::where('role', 'pegawai')->orderBy('name')->get();

        return view('pages.admin.rapat.create', compact('notulisList', 'pegawaiList'));
    }

    /**             
     * STORE RAPAT
     */                                         
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_rapat'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'jam'           => 'required',
            'ruangan'       => 'required|string|max:255',
            'notulis_id'    => 'nullable|exists:users,id',
            'prioritas'     => 'required|string',
            'status'        => 'required|string',
            'peserta_ids'   => 'array',
            'peserta_ids.*' => 'exists:users,id',
        ]);

        // Isi otomatis oleh user yang login
        $validated['dibuat_oleh'] = auth()->id();

        if (!$validated['dibuat_oleh']) {
            return redirect()->route('login')
                ->withErrors('Session habis, silakan login ulang');
        }

        // pisahkan peserta dari field lain
        $pesertaIds = $validated['peserta_ids'] ?? [];
        unset($validated['peserta_ids']);

        // ⬅️ SIMPAN RAPAT KE VARIABEL
        $rapat = Rapat::create($validated);

        // simpan peserta ke pivot
        if (!empty($pesertaIds)) {
            $rapat->peserta()->sync($pesertaIds);
        }

        return redirect()
            ->route('rapat.index')
            ->with('success', 'Rapat berhasil dibuat.');
    }


    /**
     * DETAIL RAPAT
     */
   public function show($id)
    {
        $rapat = Rapat::with(['peserta', 'notulis'])->findOrFail($id);

        return view('pages.admin.rapat.show', compact('rapat'));
    }

}
