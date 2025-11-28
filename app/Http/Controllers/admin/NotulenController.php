<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notulen;

class NotulenController extends Controller
{
    /**
     * LIST NOTULEN — halaman utama admin
     * Hanya menampilkan NOTULEN yang BELUM DISETUJUI
     */
    public function index()
    {
        $notulens = Notulen::where('status', '!=', 'disetujui')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.admin.rapat.notulen', compact('notulens'));
    }

    /**
     * REALTIME SEARCH (AJAX) — return JSON
     * Hanya mencari NOTULEN yang BELUM DISETUJUI
     */
    public function search(Request $request)
    {
        $keyword = $request->q;

        $notulens = Notulen::where('status', '!=', 'disetujui')
            ->where(function ($query) use ($keyword) {
                $query->where('judul_rapat', 'LIKE', "%{$keyword}%")
                      ->orWhere('topik', 'LIKE', "%{$keyword}%")
                      ->orWhere('status', 'LIKE', "%{$keyword}%");
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($notulens);
    }

    /**
     * HALAMAN DETAIL NOTULEN
     */
    public function show($id)
    {
        $notulen = Notulen::with('notulis')->findOrFail($id);

        return view('pages.admin.rapat.notulen-show', compact('notulen'));
    }
}
