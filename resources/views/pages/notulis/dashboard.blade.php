@extends('layouts.app-tailwind')

@section('title', 'Dashboard Notulis - E-Notulen')

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
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-green">Selamat Datang, Notulis</h1>
                <p class="text-sm text-muted mt-1">{{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}</p>
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
                        <form id="logout-form-profile" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="button" id="logoutBtnProfile"
                                class="w-full flex items-center justify-between text-sm text-brand-green px-2 py-2 rounded-lg hover:bg-gray-50">
                                Logout
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KARTU STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

    {{-- RAPAT MENDATANG --}}
    <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
        <div>
            <div class="text-xs text-muted font-semibold">Rapat Mendatang</div>
            <div class="text-2xl font-extrabold text-brand-green">{{ $rapat_mendatang }}</div>
        </div>
        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
            {{-- ICON KALENDER --}}
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V9h14v11z"/>
            </svg>
        </div>
    </div>

    {{-- RAPAT SELESAI --}}
    <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
        <div>
            <div class="text-xs text-muted font-semibold">Rapat Selesai</div>
            <div class="text-2xl font-extrabold text-brand-green">{{ $agenda_rapat }}</div>
        </div>
        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
            {{-- ICON CHECK --}}
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </div>
    </div>

    {{-- NOTULEN DISETUJUI --}}
    <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
        <div>
            <div class="text-xs text-muted font-semibold">Notulen Disetujui</div>
            <div class="text-2xl font-extrabold text-brand-green">{{ $notulen_arsip }}</div>
        </div>
        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
            {{-- ICON CHECK CIRCLE --}}
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-2 14l-4-4 1.41-1.41L10 13.17l6.59-6.59L18 8l-8 8z"/>
            </svg>
        </div>
    </div>

    {{-- REVISI NOTULEN --}}
    <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
        <div>
            <div class="text-xs text-muted font-semibold">Revisi Notulen</div>
            <div class="text-2xl font-extrabold text-brand-green">{{ $notulen_review }}</div>
        </div>
        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
            {{-- ICON EDIT --}}
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41L18.37 3.29a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
            </svg>
        </div>
    </div>

</div>


    {{-- RAPAT HARI INI --}}
    <div class="mt-6">
        <h2 class="font-extrabold text-brand-green text-lg mb-4">Rapat Hari Ini</h2>

        <div class="space-y-3">

            {{-- CARD 1 --}}
            <div class="bg-white rounded-lg p-4 shadow border flex items-start gap-4">
                <div class="p-3 rounded-md bg-emerald-100 text-emerald-700 shrink-0">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-brand-green text-sm">
                        Rapat Persiapan Kegiatan HUT Kota Banjarmasin ke-499
                    </h3>
                    <p class="text-xs text-muted mt-1">
                        Minggu, 20-02-2030 || Aula Badan Organisasi || 09:00
                    </p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="bg-yellow-400 text-black px-3 py-1 rounded font-bold text-xs">Penting</span>
                    <button class="border border-gray-300 rounded p-2 text-brand-green hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="#1E5631"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7V5a2 2 0 0 1 2-2h2m10 0h2a2 2 0 0 1 2 2v2m0 10v2a2 2 0 0 1-2 2h-2m-10 0H5a2 2 0 0 1-2-2v-2" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="bg-white rounded-lg p-4 shadow border flex items-start gap-4">
                <div class="p-3 rounded-md bg-emerald-100 text-emerald-700 shrink-0">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-brand-green text-sm">
                        Rapat Koordinasi Program Pembangunan Daerah
                    </h3>
                    <p class="text-xs text-muted mt-1">
                        Minggu, 20-02-2030 || Gedung C Bagian Organisasi || 13:00
                    </p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="bg-green-600 text-white px-3 py-1 rounded font-bold text-xs">Normal</span>
                    <button class="border border-gray-300 rounded p-2 text-brand-green hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="#1E5631"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7V5a2 2 0 0 1 2-2h2m10 0h2a2 2 0 0 1 2 2v2m0 10v2a2 2 0 0 1-2 2h-2m-10 0H5a2 2 0 0 1-2-2v-2" />
                        </svg>
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

{{-- LOGOUT CONFIRMATION MODAL --}}
<div id="logoutModalProfile" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-60">
    <div class="bg-white p-6 rounded-lg shadow-xl w-80">
        <h2 class="text-lg font-bold mb-4">Konfirmasi</h2>
        <p class="mb-6">Yakin ingin keluar?</p>

        <div class="flex justify-end gap-3">
            <button id="cancelLogoutProfile" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Batal</button>

            <button id="confirmLogoutProfile" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Keluar
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // KONFIRMASI LOGOUT (FIXED)
    const logoutBtnProfile  = document.getElementById('logoutBtnProfile');
    const logoutFormProfile = document.getElementById('logout-form-profile');
    const logoutModalProfile = document.getElementById('logoutModalProfile');
    const cancelLogoutProfile = document.getElementById('cancelLogoutProfile');
    const confirmLogoutProfile = document.getElementById('confirmLogoutProfile');

    if (logoutBtnProfile && logoutModalProfile) {
        logoutBtnProfile.addEventListener('click', function () {
            logoutModalProfile.classList.remove('hidden');
        });
    }

    if (cancelLogoutProfile && logoutModalProfile) {
        cancelLogoutProfile.addEventListener('click', function () {
            logoutModalProfile.classList.add('hidden');
        });
    }

    if (confirmLogoutProfile && logoutFormProfile && logoutModalProfile) {
        confirmLogoutProfile.addEventListener('click', function () {
            logoutFormProfile.submit();
        });
    }

    // Klik di luar modal untuk tutup
    if (logoutModalProfile) {
        logoutModalProfile.addEventListener('click', function (e) {
            if (e.target === logoutModalProfile) {
                logoutModalProfile.classList.add('hidden');
            }
        });
    }
</script>
@endpush

