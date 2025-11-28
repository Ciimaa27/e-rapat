<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ArsipAdminController extends Controller
{
    public function index()
    {
        $rows = DB::table('notulens')
            ->orderBy('tanggal', 'DESC')
            ->get();

        return view('pages.admin.rapat.arsip-admin', compact('rows'));
    }

    // 🔥 REALTIME SEARCH
    public function search(Request $request)
    {
        $q = $request->q;

        $rows = DB::table('notulens')
            ->where('judul_rapat', 'LIKE', "%$q%")
            ->orWhere('topik', 'LIKE', "%$q%")
            ->orderBy('tanggal', 'DESC')
            ->get();

        return response()->json($rows);
    }

    // ✅ SATU-SATUNYA method download: generate PDF
    public function download($id)
    {
        $notulen = DB::table('notulens')->where('id', $id)->first();

        if (! $notulen) {
            return back()->with('error', 'Data notulen tidak ditemukan.');
        }

        $pdf = Pdf::loadView('pages.pdf.notulen', [
            'notulen' => $notulen,
        ])->setPaper('A4', 'portrait');

        $filename = 'Notulen-' . $notulen->id . '.pdf';

        return $pdf->download($filename);
        // kalau mau tampil di tab baru:
        // return $pdf->stream($filename);
    }

    public function destroy($id)
    {
        $file = DB::table('notulens')->where('id', $id)->first();

        if ($file) {
            // kalau dulu kamu simpan file fisik, boleh tetap dihapus:
            $path = storage_path("app/public/notulen/{$file->file}");
            if (file_exists($path)) {
                @unlink($path);
            }

            DB::table('notulens')->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Arsip berhasil dihapus.');
    }
}
