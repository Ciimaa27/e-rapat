@extends('layouts.app-tailwind')

@section('title', 'Dashboard Pimpinan - E-Notulen')

@section('content')

{{-- HEADER --}}
<div class="p-5 mb-6">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-brand-green">
                Selamat Datang, Pimpinan
            </h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            {{-- PROFIL + DROPDOWN --}}
            <div class="relative">
                {{-- BUTTON PROFIL --}}
                <button id="profileBtn" class="p-2 rounded hover:bg-gray-100 transition" title="Profil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                {{-- DROPDOWN PROFIL --}}
                <div id="profileDropdown"
                     class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden z-20">

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

                    {{-- LOGOUT (POST + KONFIRMASI) --}}
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

                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION: BULAN INI --}}
<h2 class="text-lg font-bold text-brand-green mb-3">Bulan ini</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    {{-- CARD 1 - Rapat bulan ini --}}
    <div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">
        <div>
            <p class="text-sm font-semibold text-gray-600">Rapat bulan ini</p>
            <p class="text-3xl mt-1 font-extrabold text-brand-green">{{ $rapat_bulan_ini }}</p>
        </div>
        <i class="fa-solid fa-clipboard-list text-3xl text-gray-400"></i>
    </div>

    {{-- CARD 2 - Meminta Persetujuan --}}
    <div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">
        <div>
            <p class="text-sm font-semibold text-gray-600">Meminta Persetujuan rapat</p>
            <p class="text-3xl mt-1 font-extrabold text-brand-green">{{ $rapat_menunggu }}</p>
        </div>
        <i class="fa-solid fa-user-check text-3xl text-gray-400"></i>
    </div>

    {{-- CARD 3 - Review Notulen --}}
    <div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">
        <div>
            <p class="text-sm font-semibold text-gray-600">Review Notulen</p>
            <p class="text-3xl mt-1 font-extrabold text-brand-green">{{ $notulen_review }}</p>
        </div>
        <i class="fa-solid fa-user text-3xl text-gray-400"></i>
    </div>

</div>

{{-- SECTION: RAPAT HARI INI --}}
<h2 class="text-lg font-bold text-brand-green mt-6 mb-3">Rapat Hari ini</h2>

<div class="bg-white border rounded-lg shadow p-4 flex justify-between items-center">

    <div class="flex gap-3">

        {{-- ICON RAPAT --}}
        <div class="w-10 h-10 rounded-full bg-brand-green/20 flex items-center justify-center">
            <i class="fa-solid fa-people-group text-brand-green"></i>
        </div>

        {{-- INFO RAPAT --}}
        <div>
            <p class="font-semibold text-brand-green">
                Rapat Persiapan Kegiatan HUT Kota Banjarmasin ke–499
            </p>

            <p class="text-xs text-gray-600 italic mt-1">
                Minggu, 20–02–2030 | Aula Badan Organisasi | 09:00
            </p>
        </div>

    </div>

    <div class="flex items-center gap-3">

        {{-- BADGE PENTING --}}
        <span class="px-4 py-1 text-sm font-semibold text-white bg-yellow-500 rounded-lg">
            Penting
        </span>

        {{-- ICON FULLSCREEN / DETAIL --}}
        <button class="border border-gray-300 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
            <i class="fa-solid fa-expand"></i>
        </button>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    // Toggle show / hide dropdown profil
    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // supaya klik tombol nggak langsung ketutup oleh listener document
            profileDropdown.classList.toggle('hidden');
        });

        // Klik di luar dropdown → tutup
        document.addEventListener('click', function (e) {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
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
