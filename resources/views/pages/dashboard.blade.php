@extends('layouts.app-tailwind')

@section('title', 'Dashboard - E-Notulen')

@section('content')
    {{-- HEADER ATAS --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-brand-green">Selamat Datang, Admin</h1>
            <p class="text-sm text-muted mt-1">Minggu, 20-02-2030</p>
        </div>

        <div class="flex items-center gap-3">
            <button class="p-2 rounded-md text-brand-green hover:bg-gray-100">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 22a2 2 0 002-2H10a2 2 0 002 2zM18 8a6 6 0 10-12 0v5l-2 2v1h16v-1l-2-2V8z"/>
                </svg>
            </button>
            <button id="profileBtn" class="p-2 rounded-full bg-white shadow">
                <svg class="w-6 h-6 text-brand-green" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Admin</div>
                <div class="text-2xl font-extrabold text-brand-green">2</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM4 20v-1a7 7 0 0114 0v1H4z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Pegawai</div>
                <div class="text-2xl font-extrabold text-brand-green">37</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM8 11c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zM8 13c-2.667 0-8 1.333-8 4v2h16v-2c0-2.667-5.333-4-8-4zM16 13c0-.29.02-.578.058-.861C16.776 14.01 20 15.228 20 17v2h4v-2c0-2.667-5.333-4-8-4z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Notulis</div>
                <div class="text-2xl font-extrabold text-brand-green">10</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2v10l3-2 3 2V2H12zM3 12h6v10H3z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Pimpinan</div>
                <div class="text-2xl font-extrabold text-brand-green">4</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zM4 20v-1c0-2.21 3.582-4 8-4s8 1.79 8 4v1H4z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- RAPAT HARI INI --}}
    <div class="bg-white rounded-lg p-4 shadow border mt-6 flex items-center gap-4">
        <div class="p-3 rounded-md bg-emerald-50 text-brand-green">
            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7 10h10v2H7zM3 5h18v14H3z"/>
            </svg>
        </div>
        <div>
            <div class="font-bold">
                Rapat Persiapan Kegiatan HUT Kota Banjarmasin ke-499
            </div>
            <div class="text-sm text-muted">
                Minggu, 20-02-2030  ||  Aula Badan Organisasi  ||  09:00
            </div>
        </div>
        <div class="ml-auto flex items-center gap-2">
            <span class="bg-yellow-400 text-black px-3 py-1 rounded-md font-bold">Penting</span>
            <button class="border border-[rgba(47,107,68,0.12)] rounded-md p-2 text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 5c-7 0-12 7-12 7s5 7 12 7 12-7 12-7-5-7-12-7zM12 15a3 3 0 110-6 3 3 0 010 6z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- TABEL AGENDA RAPAT --}}
    <section class="bg-white rounded-lg p-4 shadow border mt-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <div class="font-extrabold text-brand-green">Agenda Rapat Mendatang</div>
                <div class="text-sm text-muted">Daftar rapat yang akan datang</div>
            </div>
            <div class="flex gap-2">
                <button class="bg-brand-green text-white px-3 py-1 rounded-md font-semibold">
                    + Buat Rapat
                </button>
                <button class="border border-[rgba(47,107,68,0.12)] text-brand-green px-3 py-1 rounded-md">
                    Lihat Semua
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm table-auto border-collapse">
                <thead>
                    <tr class="bg-header-gradient">
                        <th class="px-3 py-2 text-left w-2/5 font-bold">Judul Rapat</th>
                        <th class="px-3 py-2 text-left w-1/6 font-bold">Tanggal</th>
                        <th class="px-3 py-2 text-left w-1/12 font-bold">Jam</th>
                        <th class="px-3 py-2 text-left w-2/5 font-bold">Agenda</th>
                        <th class="px-3 py-2 text-left w-1/12 font-bold">Prioritas</th>
                        <th class="px-3 py-2 text-left w-1/12 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-brand-green">
                    <tr class="border-t">
                        <td class="px-3 py-3">Evaluasi Kinerja Karyawan</td>
                        <td class="px-3 py-3">21-02-2030</td>
                        <td class="px-3 py-3">09:00</td>
                        <td class="px-3 py-3">
                            Membahas kinerja pegawai terhadap masyarakat Kota Banjarmasin
                        </td>
                        <td class="px-3 py-3">
                            <span class="px-2 py-1 rounded-full text-white bg-green-600 text-xs font-bold">
                                Normal
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <span class="px-3 py-1 rounded-md text-white bg-blue-600 text-xs font-bold">
                                Disetujui
                            </span>
                        </td>
                    </tr>
                    <tr class="border-t">
                        <td class="px-3 py-3">Demo Masyarakat di DPRD</td>
                        <td class="px-3 py-3">21-02-2030</td>
                        <td class="px-3 py-3">10:00</td>
                        <td class="px-3 py-3">
                            Pencegahan kerusuhan terjadi, mengerahkan para pihak terkait
                        </td>
                        <td class="px-3 py-3">
                            <span class="px-2 py-1 rounded-full text-white bg-red-600 text-xs font-bold">
                                Darurat
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <span class="px-3 py-1 rounded-md text-white bg-blue-600 text-xs font-bold">
                                Disetujui
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const profileBtn = document.getElementById('profileBtn');
    profileBtn?.addEventListener('click', () => {
        alert('Buka menu profil (implementasikan popup sesuai preferensi).');
    });
</script>
@endpush
