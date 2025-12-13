@extends('layouts.app-tailwind')

@section('title', 'Notulen Rapat - Notulis')

@push('styles')
<style>
  /* Divider table */
  .notulen-table th,
  .notulen-table td {
      border-right: 1px solid #e6e6e6;
  }
  .notulen-table th:last-child,
  .notulen-table td:last-child {
      border-right: none;
  }
  .notulen-table tbody tr {
      border-bottom: 1px solid #e6e6e6;
  }
  .notulen-table tbody tr:last-child {
      border-bottom: none;
  }

  .badge-yellow {
      background:#fcd34d;
      color:#92400e;
      padding:.25rem .6rem;
      border-radius:9999px;
      font-weight:700;
  }
  .badge-gray  {
      background:#e5e7eb;
      color:#374151;
      padding:.25rem .6rem;
      border-radius:9999px;
      font-weight:700;
  }
</style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="p-5 mb-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-green">Notulen Rapat</h1>
                <p class="text-sm text-muted mt-1">
                    {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                {{-- PROFIL + DROPDOWN --}}
                <div class="relative">
                    {{-- BUTTON PROFIL --}}
                    <button id="profileBtn" class="p-2 rounded hover:bg-gray-100 transition" title="Profil">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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

    {{-- SEARCH + TOMBOL --}}
    <section class="bg-white rounded-lg p-4 shadow border">

        <div class="flex flex-col md:flex-row items-center gap-4 mb-4">

            {{-- SEARCH BAR --}}
            <div class="flex-1 w-full">
                <div class="relative">
                    <input type="search" placeholder="Cari judul rapat..."
                           class="w-full border rounded px-3 py-2 pl-10 text-sm bg-white" />
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.2-5.2"/>
                        </svg>
                    </span>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-2 w-full md:w-auto">
                <a href="#"
                   class="border border-[rgba(47,107,68,0.2)] text-brand-green
                          px-4 py-2 rounded font-semibold text-sm hover:bg-gray-50 transition">
                    Filter
                </a>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full text-sm notulen-table">
                <thead class="bg-pink-custom">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left font-semibold text-brand-green">Judul Rapat</th>
                        <th class="px-4 md:px-6 py-3 text-left font-semibold text-brand-green">Tanggal</th>
                        <th class="px-4 md:px-6 py-3 text-left font-semibold text-brand-green">Topik</th>
                        <th class="px-4 md:px-6 py-3 text-left font-semibold text-brand-green">Status</th>
                        <th class="px-4 md:px-6 py-3 text-left font-semibold text-brand-green">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($notulens as $notulen)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- Judul Rapat --}}
                            <td class="px-4 md:px-6 py-4 align-top font-medium text-brand-green">
                                {{ $notulen->judul_rapat ?? '-' }}
                            </td>

                            {{-- Tanggal Rapat --}}
                            <td class="px-4 md:px-6 py-4 align-top">
                                {{ $notulen->tanggal ?? '-' }}
                            </td>

                            {{-- TOPIK --}}
                            <td class="px-4 md:px-6 py-4 align-top">
                                {{ Str::limit($notulen->topik, 50) }}
                            </td>

                            {{-- Status --}}
                            <td class="px-4 md:px-6 py-4 align-top">
                                @if($notulen->status == 'Direview')
                                    <span class="badge-yellow">Direview</span>
                                @else
                                    <span class="badge-gray">Selesai</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 md:px-6 py-4 align-top space-x-3">
                                {{-- Lihat detail notulen --}}
                                <a href="{{ route('notulis.notulen.show', $notulen->id) }}"
                                class="text-blue-600 font-semibold hover:underline">
                                    Lihat Detail
                                </a>

                            {{-- Transkrip audio --}}
                            <a href="{{ route('notulis.transkrip.create', $notulen->rapat_id) }}"
                                class="text-emerald-700 font-semibold hover:underline">
                                    Transkrip Audio
                            </a>
                            </td>                   
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Belum ada notulen.
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
            e.stopPropagation(); // biar klik tombol nggak langsung ketutup oleh listener document
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
