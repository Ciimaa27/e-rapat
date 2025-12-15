@extends('layouts.app-tailwind')

@section('title', 'Dashboard Pegawai - E-Notulen')

@section('content')

{{-- HEADER --}}
<div class="p-5 mb-6">
    <div class="flex items-start justify-between">
        
        {{-- WELCOME TEXT --}}
        <div>
            <h1 class="text-2xl font-extrabold text-brand-green">
                Selamat Datang, Pegawai
            </h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        {{-- ICON PROFILE --}}
        <div class="flex items-center gap-3">
            {{-- Profile + Dropdown --}}
            <div class="relative">
                <!-- BUTTON PROFIL -->
                <button id="profileBtn" class="p-2 rounded hover:bg-gray-100 transition" title="Profil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                <!-- DROPDOWN PROFIL -->
                <div id="profileDropdown" class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden z-20">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-brand-green">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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

                    {{-- LOGOUT (POST + KONFIRMASI) --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="button" id="logoutBtn" class="w-full flex items-center justify-between text-sm text-brand-green px-2 py-2 rounded-lg hover:bg-gray-50">
                            Logout
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- RAPAT HARI INI --}}
<h2 class="text-lg font-bold text-brand-green mb-3">Rapat Hari ini</h2>

<div class="space-y-3">

    {{-- ITEM RAPAT 1 --}}
    <div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">
        <div class="flex gap-3">

            <div class="w-12 h-12 bg-brand-green/20 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-calendar-day text-2xl text-brand-green"></i>
            </div>

            <div>
                <p class="font-semibold text-brand-green">
                    Rapat Persiapan Kegiatan HUT Kota Banjarmasin ke–499
                </p>

                <p class="text-xs text-gray-600 italic mt-1">
                    Minggu, 20–02–2030 || Aula Badan Organisasi || 09:00
                </p>
            </div>

        </div>

        <div class="flex items-center gap-3">

            <span class="px-4 py-1 text-sm font-semibold text-white bg-yellow-500 rounded-lg">
                Penting
            </span>

            <button class="border border-gray-300 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                <i class="fa-solid fa-expand"></i>
            </button>

        </div>
    </div>

    {{-- ITEM RAPAT 2 --}}
    <div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">
        <div class="flex gap-3">

            <div class="w-12 h-12 bg-brand-green/20 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-calendar-day text-2xl text-brand-green"></i>
            </div>

            <div>
                <p class="font-semibold text-brand-green">
                    Rapat Koordinasi Program Pembangunan Daerah
                </p>

                <p class="text-xs text-gray-600 italic mt-1">
                    Minggu, 20–02–2030 || Gedung C Bagian Organisasi || 13:00
                </p>
            </div>

        </div>

        <div class="flex items-center gap-3">

            <span class="px-4 py-1 text-sm font-semibold text-white bg-green-500 rounded-lg">
                Normal
            </span>

            <button class="border border-gray-300 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                <i class="fa-solid fa-expand"></i>
            </button>

        </div>
    </div>

</div>


{{-- AGENDA RAPAT MENDATANG --}}
<h2 class="text-lg font-bold text-brand-green mt-8 mb-3">Agenda Rapat Mendatang</h2>

<div class="bg-white border rounded-lg shadow p-4">

    <div class="flex justify-end mb-2">
        <a href="{{ route('pegawai.jadwal.index') }}" class="bg-brand-green text-white text-sm px-3 py-1 rounded hover:bg-brand-green/80">
            Lihat Semua
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-[#F8C2C2] text-brand-green font-semibold text-left">
                    <th class="p-3">Judul Rapat</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Jam</th>
                    <th class="p-3">Agenda</th>
                    <th class="p-3">Ruangan</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">Evaluasi Kinerja Karyawan</td>
                    <td class="p-3">21–02–2030</td>
                    <td class="p-3">09:00</td>
                    <td class="p-3">Membahas kinerja pegawai terhadap masyarakat Kota B...</td>
                    <td class="p-3">Gedung B, kantor Diskominfo</td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">Demo Masyarakat di DPRD</td>
                    <td class="p-3">21–02–2030</td>
                    <td class="p-3">10:00</td>
                    <td class="p-3">Pencegahan kerusuhan terjadi, mengerahkan para p...</td>
                    <td class="p-3">Aula Kayuh Baimbai, SETDAKO Banjarmasin</td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="p-3">Rapat Koordinasi Daerah</td>
                    <td class="p-3">23–02–2030</td>
                    <td class="p-3">14:00</td>
                    <td class="p-3">Rapat koordinasi daerah daerah yang belum mendap...</td>
                    <td class="p-3">Gedung C, Kantor Sekretariat</td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

@endsection

@push('scripts')
<script>
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    // Toggle show / hide
    if (btn && dropdown) {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
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
