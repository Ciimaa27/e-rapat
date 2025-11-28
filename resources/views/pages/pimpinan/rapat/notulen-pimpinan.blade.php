@extends('layouts.app-tailwind')

@section('title', 'Notulen Rapat - E-Notulen')

@push('styles')
<style>
    .badge-review {
        background:#ffd86b;
        color:#3b2e00;
        font-weight:700;
        padding:6px 10px;
        border-radius:8px;
        font-size:11px;
    }
    .badge-done {
        background:#d1d5db;
        color:#333;
        font-weight:700;
        padding:6px 10px;
        border-radius:8px;
        font-size:11px;
    }
</style>
@endpush


@section('content')

{{-- =================================== --}}
{{-- HEADER --}}
{{-- =================================== --}}
<div class="p-5 mb-6">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Notulen Rapat</h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        {{-- PROFILE --}}
        <div class="flex items-center gap-3">
            <div class="relative">
                <button id="profileBtn"
                        class="p-2 rounded hover:bg-gray-100 transition"
                        title="Profil">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9
                                 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15
                                 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                {{-- DROPDOWN --}}
                <div id="profileDropdown"
                     class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden z-20">

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-brand-green">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488
                                         7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963
                                         0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966
                                         0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3
                                         0 0 1 6 0Z" />
                            </svg>
                        </div>

                        <div>
                            <div class="font-bold text-brand-green">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->role }}</div>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="button" id="logoutBtn"
                                class="w-full flex items-center justify-between text-sm text-brand-green px-2 py-2 rounded-lg hover:bg-gray-50">
                            Logout
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 9V5.25A2.25 2.25 0 0013.5
                                         3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25
                                         0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12
                                         9l3 3m0 0l-3 3m3-3H3" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- =================================== --}}
{{-- CARD WRAPPER --}}
{{-- =================================== --}}
<section class="bg-white rounded-lg p-4 shadow border">

    {{-- SEARCH + FILTER --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">

        {{-- SEARCH --}}
        <div class="relative w-full md:w-1/2">
            <input id="searchNotulen" type="text"
                   placeholder="Cari judul rapat..."
                   class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                          focus:outline-none focus:border-brand-green">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5
                             7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607
                             10.607Z" />
                </svg>
            </span>
        </div>

        {{-- FILTER --}}
        <button
            class="px-5 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                   hover:bg-pink-custom-hover transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5
                         0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75
                         6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0
                         1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75
                         0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0
                         1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
            <span>Filter</span>
        </button>

    </div>


    {{-- TABLE --}}
    <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
        <table id="notulenTable" class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-pink-custom">
                <tr>
                    <th class="px-4 py-3 text-left font-bold text-brand-green">Judul Rapat</th>
                    <th class="px-4 py-3 text-left font-bold text-brand-green">Tanggal</th>
                    <th class="px-4 py-3 text-left font-bold text-brand-green">Jam</th>
                    <th class="px-4 py-3 text-left font-bold text-brand-green hidden sm:table-cell">Agenda</th>
                    <th class="px-4 py-3 text-left font-bold text-brand-green">Status</th>
                    <th class="px-4 py-3 text-left font-bold text-brand-green">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($notulens as $note)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-brand-green font-semibold">{{ $note->judul_rapat }}</td>
                    <td class="px-4 py-4">{{ $note->tanggal }}</td>
                    <td class="px-4 py-4">{{ $note->jam }}</td>
                    <td class="px-4 py-4 hidden sm:table-cell">{{ Str::limit($note->topik, 60) }}</td>
                    <td class="px-4 py-4">
                        <span class="{{ strtolower($note->status)=='selesai'
                                       ? 'badge-done' : 'badge-review' }}">
                            {{ $note->status }}
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <a href="{{ route('pimpinan.notulen.show', $note->id) }}"
                           class="text-blue-600 font-semibold hover:underline">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        Belum ada notulen rapat.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</section>

@endsection


{{-- =================================== --}}
{{-- SCRIPT SEARCH REALTIME --}}
{{-- =================================== --}}
@push('scripts')
<script>

const searchInput = document.getElementById('searchNotulen');
const tbody       = document.querySelector('#notulenTable tbody');

searchInput.addEventListener('keyup', function () {

    let q = this.value.trim();

    fetch("{{ route('pimpinan.notulen.search') }}?q=" + encodeURIComponent(q))
        .then(res => res.json())
        .then(data => {

            let rows = "";

            // JIKA RESPONSE KOSONG, BERARTI TAMPILKAN SEMUA DATA AWAL
            if (data.length === 0 && q === "") {
                rows = `
                    @foreach ($notulens as $note)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-brand-green font-semibold">{{ $note->judul_rapat }}</td>
                            <td class="px-4 py-4">{{ $note->tanggal }}</td>
                            <td class="px-4 py-4">{{ $note->jam }}</td>
                            <td class="px-4 py-4 hidden sm:table-cell">{{ Str::limit($note->topik, 60) }}</td>
                            <td class="px-4 py-4">
                                <span class="{{ strtolower($note->status)=='selesai' ? 'badge-done' : 'badge-review' }}">
                                    {{ $note->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <a href="{{ route('pimpinan.notulen.show', $note->id) }}"
                                   class="text-blue-600 font-semibold hover:underline">
                                   Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                `;
            }
            else if (data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            Tidak ada notulen ditemukan.
                        </td>
                    </tr>`;
            }
            else {

                data.forEach(n => {
                    let badge = n.status.toLowerCase() === 'selesai'
                                ? 'badge-done'
                                : 'badge-review';

                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-brand-green font-semibold">${n.judul_rapat}</td>
                            <td class="px-4 py-4">${n.tanggal}</td>
                            <td class="px-4 py-4">${n.jam ?? '-'}</td>
                            <td class="px-4 py-4 hidden sm:table-cell">${n.topik?.substring(0,60) ?? '-'}</td>
                            <td class="px-4 py-4"><span class="${badge}">${n.status}</span></td>
                            <td class="px-4 py-4">
                                <a href="/pimpinan/notulen/${n.id}"
                                   class="text-blue-600 font-semibold hover:underline">
                                   Lihat Detail
                                </a>
                            </td>
                        </tr>`;
                });
            }

            tbody.innerHTML = rows;
        });
});


/* PROFILE DROPDOWN */
const profileBtn      = document.getElementById("profileBtn");
const profileDropdown = document.getElementById("profileDropdown");

profileBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle("hidden");
});

document.addEventListener("click", (e) => {
    if (!profileBtn.contains(e.target) &&
        !profileDropdown.contains(e.target)) {
        profileDropdown.classList.add("hidden");
    }
});

/* LOGOUT */
document.getElementById("logoutBtn")
        .addEventListener("click", function () {
    if (confirm("Yakin ingin keluar dari aplikasi?")) {
        document.getElementById("logout-form").submit();
    }
});
</script>
@endpush
