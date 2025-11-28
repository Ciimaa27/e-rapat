<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Rapat;
use Illuminate\Http\Request;

class AgendaPimpinanController extends Controller
{
    /**
     * LIST AGENDA RAPAT PIMPINAN
     */
    public function index()
    {
        $rapats = Rapat::latest()->get();
        return view('pages.pimpinan.rapat.index', compact('rapats'));
    }

    /**
     * DETAIL RAPAT
     */
    public function show($id)
    {
        $rapat = Rapat::findOrFail($id);
        return view('pages.pimpinan.rapat.detail-index', compact('rapat'));
    }

    /**
     * UPDATE STATUS RAPAT
     * (Menunggu, Ditunda, Disetujui)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Ditunda,Disetujui',
        ]);

        $rapat = Rapat::findOrFail($id);
        $rapat->status = $request->status;
        $rapat->save();

        return redirect()
            ->route('pimpinan.rapat.index')
            ->with('success', 'Status rapat berhasil diperbarui.');
    }

    /**
     * 🔥 REALTIME SEARCH — Return JSON
     */
    public function search(Request $request)
    {
        $keyword = $request->q;

        $rapats = Rapat::where('judul_rapat', 'like', "%{$keyword}%")
            ->orWhere('tanggal', 'like', "%{$keyword}%")
            ->orWhere('jam', 'like', "%{$keyword}%")
            ->orWhere('ruangan', 'like', "%{$keyword}%")
            ->orWhere('prioritas', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($rapats);
    }
}
