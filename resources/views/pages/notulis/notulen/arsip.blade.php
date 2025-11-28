@extends('layouts.app-tailwind')

@section('title', 'Arsip Rapat - Notulis')

@push('styles')
<style>
    /* Tabel garis pembatas */
    .arsip-table th,
    .arsip-table td {
        border-right: 1px solid #e5e7eb;
    }
    .arsip-table th:last-child,
    .arsip-table td:last-child {
        border-right: none;
    }
    .arsip-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }
    .arsip-table tbody tr:last-child {
        border-bottom: none;
    }
</style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="p-5 mb-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-green">Arsip Rapat</h1>
                <p class="text-sm text-muted mt-1">
                    {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
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

    <section class="bg-white rounded-lg p-4 shadow border">

        {{-- SEARCH --}}
        <div class="mb-4">
            <input type="text"
                   placeholder="Cari judul rapat..."
                   class="w-80 max-w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-brand-green">
        </div>

        {{-- TABLE (disamakan dengan Jadwal Rapat) --}}
        <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm arsip-table">

                {{-- HEADER PINK SAMA DENGAN JADWAL --}}
                <thead class="bg-pink-custom">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Judul Rapat</th>
                        <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Tanggal</th>
                        <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Topik</th>
                        <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Aksi</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rows as $row)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- Judul --}}
                            <td class="px-4 md:px-6 py-3 align-top text-brand-green font-semibold">
                                {{ $row->judul_rapat }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-4 md:px-6 py-3 align-top whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                            </td>

                            {{-- Topik --}}
                            <td class="px-4 md:px-6 py-3 align-top">
                                {{ \Illuminate\Support\Str::limit($row->topik, 80) }}
                            </td>

                            {{-- Aksi (Download) --}}
                            <td class="px-4 md:px-6 py-3 align-top">
                                <a href="{{ route('pimpinan.notulen.show', $row->id) }}"
                                   class="text-blue-600 font-semibold hover:underline">
                                    Unduh
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Belum ada arsip notulen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </section>

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
