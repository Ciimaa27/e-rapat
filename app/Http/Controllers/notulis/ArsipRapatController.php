<?php

namespace App\Http\Controllers\Notulis;

use App\Http\Controllers\Controller;
use App\Models\Notulen;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
        $notulen = DB::table('notulens')->where('id', $id)->first();

        if (! $notulen) {
            return back()->with('error', 'Data notulen tidak ditemukan.');
        }

        // Generate PDF seperti Admin
        $pdf = Pdf::loadView('pages.pdf.notulen', [
            'notulen' => $notulen,
        ])->setPaper('A4', 'portrait');

        $filename = 'Notulen-' . $notulen->id . '.pdf';

        return $pdf->download($filename);
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

