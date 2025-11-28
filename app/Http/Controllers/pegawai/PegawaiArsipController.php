<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Notulen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PegawaiArsipController extends Controller
{
    public function index()
    {
        $rows = Notulen::where('status', 'Disetujui')
            ->latest()
            ->get(['id', 'judul_rapat', 'tanggal', 'topik', 'file']);

        return view('pages.pegawai.jadwal.arsip-pegawai', compact('rows'));
    }

    // 🔥 SEARCH REALTIME ARSIP PEGAWAI
    public function search(Request $request)
    {
        $keyword = $request->q;

        $rows = Notulen::where('status', 'Disetujui')
            ->where(function ($query) use ($keyword) {
                $query->where('judul_rapat', 'like', "%{$keyword}%")
                      ->orWhere('tanggal', 'like', "%{$keyword}%")
                      ->orWhere('topik', 'like', "%{$keyword}%");
            })
            ->orderBy('tanggal', 'desc')
            ->get(['id', 'judul_rapat', 'tanggal', 'topik', 'file']);

        return response()->json($rows);
    }

    public function download($id)
    {
        $notulen = Notulen::findOrFail($id);

        if (!$notulen->file || !Storage::exists($notulen->file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($notulen->file);
    }
}
