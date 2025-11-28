<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Notulen;
use Illuminate\Http\Request;

class ArsipPimpinanController extends Controller
{
    public function index()
    {
        $rows = Notulen::where('status', 'Disetujui')
                        ->latest()
                        ->get(['id','judul_rapat','tanggal','topik']);

        return view('pages.pimpinan.rapat.arsip-pimpinan', compact('rows'));
    }

    // 🔎 SEARCH REALTIME
    public function search(Request $request)
    {
        $q = $request->q;

        $rows = Notulen::where('status', 'Disetujui')
                        ->where(function ($s) use ($q) {
                            $s->where('judul_rapat', 'like', "%$q%")
                              ->orWhere('tanggal', 'like', "%$q%")
                              ->orWhere('topik', 'like', "%$q%");
                        })
                        ->orderBy('tanggal', 'desc')
                        ->get(['id','judul_rapat','tanggal','topik']);

        return response()->json($rows);
    }
}
