<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rapat; 
use App\Models\Notulen;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * DASHBOARD PEGAWAI
     */
    public function dashboard()
    {
        return view('pages.pegawai.dashboard');
    }


    /**
     * HALAMAN LIST AGENDA RAPAT PEGAWAI
     */
    public function agendaIndex()
    {
        // Ambil semua rapat terbaru
        $rapats = Rapat::latest()->get();

        return view('pages.pegawai.jadwal.index', compact('rapats'));
    }


    /**
     * 🔍 REALTIME SEARCH — AGENDA RAPAT PEGAWAI
     */
    public function searchAgenda(Request $request)
    {
        $keyword = $request->q;

        // Jika input kosong, kembalikan semua rapat
        if (!$keyword) {
            return response()->json(
                Rapat::latest()->get()
            );
        }

        // Jika ada keyword → filter
        $rapats = Rapat::where('judul_rapat', 'like', "%{$keyword}%")
            ->orWhere('tanggal', 'like', "%{$keyword}%")
            ->orWhere('jam', 'like', "%{$keyword}%")
            ->orWhere('ruangan', 'like', "%{$keyword}%")
            ->orWhere('prioritas', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orderBy('tanggal', 'asc')
            ->get();

        return response()->json($rapats);
    }


    /**
     * DETAIL AGENDA RAPAT PEGAWAI
     */
    public function agendaShow($id)
    {
        $rapat = Rapat::findOrFail($id);

        return view('pages.pegawai.jadwal.detail', compact('rapat'));
    }


    /**
     * HALAMAN ARSIP NOTULEN PEGAWAI
     * (Hanya Notulen berstatus "Disetujui")
     */
    public function indexArsip()
    {
        $rows = Notulen::where('status', 'Disetujui')
            ->latest()
            ->get(['id','judul_rapat','tanggal','topik','file']);

        return view('pages.pegawai.jadwal.arsip-pegawai', compact('rows'));
    }


    /**
     * DOWNLOAD FILE NOTULEN PEGAWAI
     */
    public function download($id)
    {
        $notulen = Notulen::findOrFail($id);

        if (!$notulen->file || !Storage::exists($notulen->file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($notulen->file);
    }

   public function scanPresensi($rapat_id)
    {
        $rapat = Rapat::find($rapat_id);

        if (!$rapat) {
            return "Rapat tidak ditemukan.";
        }

        $user = auth()->user();

        // Cek apakah user adalah peserta rapat
        $isPeserta = $rapat->peserta->contains('id', $user->id);

        if (!$isPeserta) {
            return view('pages.admin.rapat.presensi-sukses')->with([
                'rapat' => $rapat,
                'message' => 'Anda tidak terdaftar sebagai peserta rapat ini.'
            ]);
        }

        // Cek apakah sudah absen sebelumnya
        $already = \DB::table('presensi_rapat')
            ->where('user_id', $user->id)
            ->where('rapat_id', $rapat_id)
            ->exists();

        if ($already) {
            return view('pages.admin.rapat.presensi.sukses')->with([
                'rapat' => $rapat,
                'message' => 'Anda sudah melakukan presensi sebelumnya!'
            ]);
        }

        // Catat ke database
        \DB::table('presensi_rapat')->insert([
            'user_id' => $user->id,
            'rapat_id' => $rapat_id,
            'waktu_hadir' => now(),
        ]);

        return view('pages.admin.rapat.presensi.sukses')->with([
            'rapat' => $rapat,
            'message' => 'Presensi berhasil dicatat!'
        ]);
    }
}
