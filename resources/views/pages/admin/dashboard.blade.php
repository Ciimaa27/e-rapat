@extends('layouts.app-tailwind')

@section('title', 'Dashboard - E-Notulen')

@push('styles')
<style>
    .table-divider th,
    .table-divider td {
        border-right: 1px solid #e5e7eb;
    }

    .table-divider th:last-child,
    .table-divider td:last-child {
        border-right: none;
    }
</style>
@endpush

@section('content')
<div class="p-5 mb-6">

    {{-- HEADER ATAS: WELCOME + PROFIL --}}
    <div class="flex items-start justify-between">
        
        {{-- WELCOME TEXT --}}
        <div>
            <h1 class="text-2xl font-extrabold text-brand-green">
                Selamat Datang, Admin
                {{-- kalau mau pakai nama user:
                Selamat Datang, {{ Auth::user()->name }}
                --}}
            </h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        {{-- ICON NOTIF + PROFILE --}}
        <div class="flex items-center gap-3">
            {{-- Profile + Dropdown --}}
            <div class="relative">
                <!-- BUTTON PROFIL -->
                <button id="profileBtn" class="p-2 rounded hover:bg-gray-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                <!-- DROPDOWN PROFIL -->
                <div id="profileDropdown"
                     class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden">

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-brand-green">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>

                        <div>
                            <div class="font-bold text-brand-green">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ Auth::user()->role }}
                            </div>
                        </div>
                    </div>

                    {{-- Logout --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="button" id="logoutBtn"
                                class="w-full flex items-center justify-between text-sm text-brand-green px-2 py-2 rounded-lg hover:bg-gray-50">
                            Logout
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                            </svg>
                        </button>
                    </form>
                </div> {{-- end #profileDropdown --}}
            </div> {{-- end .relative --}}
        </div> {{-- end .flex items-center --}}
    </div> {{-- end header --}}

    {{-- ======================= --}}
    {{--   CONTENT DASHBOARD     --}}
    {{-- ======================= --}}

    {{-- STATISTIK KARTU --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
        {{-- Card Admin --}}
        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Admin</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $count_admin }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM4 20v-1a7 7 0 0114 0v1H4z"/>
                </svg>
            </div>
        </div>

        {{-- Card Pegawai --}}
        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Pegawai</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $count_pegawai }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM8 11c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zM8 13c-2.667 0-8 1.333-8 4v2h16v-2c0-2.667-5.333-4-8-4zM16 13c0-.29.02-.578.058-.861C16.776 14.01 20 15.228 20 17v2h4v-2c0-2.667-5.333-4-8-4z"/>
                </svg>
            </div>
        </div>

        {{-- Card Notulis --}}
        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Notulis</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $count_notulis }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2v10l3-2 3 2V2H12zM3 12h6v10H3z"/>
                </svg>
            </div>
        </div>

        {{-- Card Pimpinan --}}
        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Pimpinan</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $count_pimpinan }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zM4 20v-1c0-2.21 3.582-4 8-4s8 1.79 8 4v1H4z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- RAPAT HARI INI --}}
    <h2 class="text-lg font-bold text-brand-green mt-3">Rapat Hari ini</h2>
    <div class="bg-white rounded-lg p-5 shadow border mt-6 flex flex-col md:flex-row items-start md:items-center gap-4">
        <div class="p-3 rounded-md bg-emerald-50 text-brand-green shrink-0">
            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7 10h10v2H7zM3 5h18v14H3z"/>
            </svg>
        </div>
        <div class="flex-1">
            <div class="font-bold text-brand-green">Rapat Persiapan Kegiatan HUT Kota Banjarmasin ke-499</div>
            <div class="text-sm text-muted mt-1">Minggu, 20-02-2030  ||  Aula Badan Organisasi  ||  09:00</div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <span class="bg-yellow-400 text-black px-3 py-1 rounded font-bold text-sm">Penting</span>
            <button class="border border-[rgba(47,107,68,0.2)] rounded p-2 text-brand-green hover:bg-gray-50 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 5c-7 0-12 7-12 7s5 7 12 7 12-7 12-7-5-7-12-7zM12 15a3 3 0 110-6 3 3 0 010 6z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- TABEL AGENDA RAPAT --}}
    <section class="bg-white rounded-lg p-5 shadow border mt-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-5">
            <div>
                <div class="font-extrabold text-brand-green text-lg">Agenda Rapat Mendatang</div>
                <div class="text-sm text-muted">Daftar rapat yang akan datang</div>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <a href="{{ route('rapat.create') }}">
                    <button class="flex-1 md:flex-none bg-brand-green text-white px-4 py-2 rounded font-semibold hover:bg-emerald-800 transition text-sm">
                        + Buat Rapat
                    </button>
                </a>
                <a href="{{ route('rapat.index') }}">
                    <button class="flex-1 md:flex-none border border-[rgba(47,107,68,0.2)] text-brand-green px-4 py-2 rounded font-semibold hover:bg-gray-50 transition text-sm">
                        Lihat Semua
                    </button>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto border rounded-lg">
            <table class="min-w-full text-sm border-collapse table-divider">
                <thead class="bg-header-gradient text-brand-green">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold">Judul Rapat</th>
                        <th class="px-4 py-3 text-left font-bold">Tanggal</th>
                        <th class="px-4 py-3 text-left font-bold">Jam</th>
                        <th class="px-4 py-3 text-left font-bold">Agenda</th>
                        <th class="px-4 py-3 text-left font-bold">Prioritas</th>
                        <th class="px-4 py-3 text-left font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-brand-green">
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium">Evaluasi Kinerja Karyawan</td>
                        <td class="px-4 py-3">21-02-2030</td>
                        <td class="px-4 py-3">09:00</td>
                        <td class="px-4 py-3">Membahas kinerja pegawai terhadap masyarakat Kota B..</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 rounded-full text-white bg-green-600 text-xs font-bold">
                                Normal
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 rounded text-white bg-blue-600 text-xs font-bold">
                                Disetujui
                            </span>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium">Demo Masyarakat di DPRD</td>
                        <td class="px-4 py-3">21-02-2030</td>
                        <td class="px-4 py-3">10:00</td>
                        <td class="px-4 py-3">Pencegahan kerusuhan terjadi, mengerahkan para p..</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 rounded-full text-white bg-red-600 text-xs font-bold">
                                Darurat
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 rounded text-white bg-blue-600 text-xs font-bold">
                                Disetujui
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    if (btn && dropdown) {
        // Toggle show / hide
        btn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Klik di luar dropdown → tutup
        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // KONFIRMASI LOGOUT
    const logoutBtn  = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logout-form');

    if (logoutBtn && logoutForm) {
        logoutBtn.addEventListener('click', function () {
            if (confirm('Yakin ingin keluar dari aplikasi?')) {
                logoutForm.submit();
            }
        });
    }
</script>
@endpush
