<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notulen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class NotulenPimpinanController extends Controller
{
    /**
     * LIST NOTULEN UNTUK PIMPINAN
     * Tidak menampilkan: Disetujui, Selesai, Arsip
     */
    public function index()
    {
        $notulens = Notulen::whereNotIn('status', ['Disetujui', 'Selesai', 'Arsip'])
                            ->latest()
                            ->get();

        return view('pages.pimpinan.rapat.notulen-pimpinan', compact('notulens'));
    }

    /**
     * HALAMAN DETAIL NOTULEN
     */
    public function show($id)
    {
        $notulen = Notulen::with('notulis')->findOrFail($id);

        return view('pages.pimpinan.rapat.notulen-detail', compact('notulen'));
    }

    /**
     * UPDATE STATUS NOTULEN (Direview, Revisi, Disetujui)
     * Jika Disetujui → pindah ke arsip
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Direview,Revisi,Disetujui',
        ]);

        $notulen = Notulen::findOrFail($id);
        $notulen->status = $request->status;
        $notulen->save();

        // STATUS LOGIC
        if ($request->status === 'Disetujui') {
            return redirect()
                ->route('pimpinan.arsip.index') // route arsip pimpinan
                ->with('success', 'Notulen berhasil disetujui dan dipindahkan ke arsip.');
        }

        if ($request->status === 'Revisi') {
            return redirect()
                ->route('pimpinan.notulen.index')
                ->with('success', 'Notulen telah dikembalikan untuk revisi.');
        }

        return redirect()
            ->route('pimpinan.notulen.index')
            ->with('success', 'Status notulen berhasil diperbarui.');
    }
    public function search(Request $request)
{
    $keyword = $request->q;

    $notulens = Notulen::whereNotIn('status', ['Disetujui', 'revisi', 'Menunggu'])
        ->where(function ($query) use ($keyword) {
            $query->where('judul_rapat', 'like', "%{$keyword}%")
                ->orWhere('tanggal', 'like', "%{$keyword}%")
                ->orWhere('jam', 'like', "%{$keyword}%")
                ->orWhere('topik', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%");
        })
        ->orderBy('tanggal', 'desc')
        ->get();

    return response()->json($notulens);
}
public function download($id)
{
    $notulen = DB::table('notulens')->where('id', $id)->first();

    if (!$notulen) {
        return back()->with('error', 'Data tidak ditemukan.');
    }

    $pdf = Pdf::loadView('pages.pdf.notulen', [
        'notulen' => $notulen
    ])->setPaper('A4', 'portrait');

    ob_clean(); // cegah PDF rusak

    return $pdf->download('Notulen-'.$notulen->id.'.pdf');
}
}
