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

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Rapat Mendatang</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $rapat_mendatang }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Rapat Selesai</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $agenda_rapat }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a3 3 0 100-6 3 3 0 000 6zM4 20v-1a7 7 0 0114 0v1H4z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Notulen Disetujui</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $notulen_arsip }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2v10l3-2 3 2V2H12z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow flex items-center justify-between border">
            <div>
                <div class="text-xs text-muted font-semibold">Revisi Notulen</div>
                <div class="text-2xl font-extrabold text-brand-green">{{ $notulen_review }}</div>
            </div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-brand-green">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10z"/>
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
