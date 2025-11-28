<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notulen;
use App\Models\Rapat;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        switch ($user->role) {

            // ======================
            // DASHBOARD ADMIN
            // ======================
            case 'admin':
                return view('pages.admin.dashboard', [
                    'count_admin'    => User::countByRole('admin'),
                    'count_pegawai'  => User::countByRole('pegawai'),
                    'count_notulis'  => User::countByRole('notulis'),
                    'count_pimpinan' => User::countByRole('pimpinan'),
                ]);

            // ======================
            // DASHBOARD NOTULIS
            // ======================
            case 'notulis':

                $notulisId = $user->id;

                // 🔥 RAPAT MENDATANG (tanggal > hari ini)
                $rapat_mendatang = Rapat::where('notulis_id', $notulisId)
                                        ->where('tanggal', '>', Carbon::today())
                                        ->count();

                return view('pages.notulis.dashboard', [

                    // CARD 1 — rapat mendatang
                    'rapat_mendatang' => $rapat_mendatang,

                    // CARD 2 — rapat selesai
                    'agenda_rapat' => Rapat::where('notulis_id', $notulisId)->count(),

                    // CARD 3 — notulen disetujui
                    'notulen_arsip' => Notulen::where('notulis_id', $notulisId)
                                            ->where('status', 'disetujui')
                                            ->count(),

                    // CARD 4 — revisi notulen
                    'notulen_review' => Notulen::where('notulis_id', $notulisId)
                                            ->where('status', 'direvisi')
                                            ->count(),
                ]);


            // ======================
            // DASHBOARD PIMPINAN
            // ======================
            case 'pimpinan':

                // Waktu sekarang
                $bulan = now()->month;
                $tahun = now()->year;

                return view('pages.pimpinan.dashboard', [

                    // CARD 1 — jumlah rapat dalam bulan ini
                    'rapat_bulan_ini' => Rapat::whereMonth('tanggal', $bulan)
                                              ->whereYear('tanggal', $tahun)
                                              ->count(),

                    // CARD 2 — agenda rapat menunggu disetujui
                    'rapat_menunggu' => Rapat::where('status', 'menunggu disetujui')
                                              ->count(),

                    // CARD 3 — notulen masih direview
                    'notulen_review' => Notulen::where('status', 'direview')
                                              ->count(),
                ]);


            // ======================
            // DASHBOARD PEGAWAI
            // ======================
            case 'pegawai':
            default:
                return view('pages.pegawai.dashboard');
        }
    }
}
