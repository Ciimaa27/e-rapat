<?php

namespace App\Http\Controllers\Notulis;

use App\Http\Controllers\Controller;
use App\Models\Notulen;
use Illuminate\Support\Facades\Storage;

class ArsipRapatController extends Controller
{
    public function index()
    {
        // Hanya notulen yang disetujui, milik notulis yang sedang login
        $rows = Notulen::where('status', 'Disetujui')
            ->where('notulis_id', auth()->id())
            ->latest()
            ->get(['id','judul_rapat','tanggal','topik','file']);

        return view('pages.notulis.notulen.arsip', compact('rows'));
    }

    public function download($id)
    {
        $notulen = Notulen::findOrFail($id);

        if (!$notulen->file || !Storage::exists($notulen->file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($notulen->file);
    }

    public function destroy($id)
    {
        $notulen = Notulen::findOrFail($id);

        // Hapus file jika ada
        if ($notulen->file && Storage::exists($notulen->file)) {
            Storage::delete($notulen->file);
        }

        $notulen->delete();

        return redirect()->route('notulis.notulen.index')
            ->with('success', 'Arsip berhasil dihapus.');
    }
}

