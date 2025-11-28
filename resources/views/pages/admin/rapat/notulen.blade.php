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

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Notulen rapat</h1>
        <p class="text-sm text-muted mt-1">
            {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
        </p>
    </div>

    {{-- PROFILE --}}
    <div class="relative">
        <button id="profileBtn" class="p-2 rounded hover:bg-gray-100 transition" title="Profil">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </button>

        <div id="profileDropdown"
            class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden z-20">

            {{-- USER INFO --}}
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

            {{-- LOGOUT --}}
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

{{-- CONTENT --}}
<section class="bg-white rounded-lg p-4 shadow border">

    {{-- SEARCH --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
        <div class="flex-1">
            <div class="relative">
                <input
                    type="text"
                    id="searchNotulen"
                    placeholder="Cari judul rapat..."
                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                        focus:outline-none focus:border-brand-green"
                >
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-custom">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Judul Rapat</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green hidden sm:table-cell">Agenda</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Aksi</th>
                </tr>
            </thead>

            <tbody id="notulenTableBody" class="bg-white divide-y divide-gray-200">

                @forelse ($notulens as $note)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-sm font-medium text-brand-green">{{ $note->judul_rapat }}</td>
                    <td class="px-4 py-4 text-sm">{{ $note->tanggal }}</td>
                    <td class="px-4 py-4 text-sm">{{ $note->jam ?? '-' }}</td>
                    <td class="px-4 py-4 text-sm hidden sm:table-cell">
                        {{ \Illuminate\Support\Str::limit($note->topik, 60) ?? '-' }}
                    </td>
                    <td class="px-4 py-4 text-sm">
                        <span class="{{ strtolower($note->status)=='disetujui' ? 'badge-done' : 'badge-review' }}">
                            {{ $note->status }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-sm">
                        <a class="text-blue-600 font-semibold hover:underline transition"
                            href="{{ route('admin.notulen-show', $note->id) }}">
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

@push('scripts')
<script>

// -------------------------
// DROPDOWN PROFILE SCRIPT
// -------------------------
const profileBtn = document.getElementById("profileBtn");
const profileDropdown = document.getElementById("profileDropdown");

// toggle open/close
profileBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    profileDropdown.classList.toggle("hidden");
});

// close on click outside
document.addEventListener("click", function (e) {
    if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
        profileDropdown.classList.add("hidden");
    }
});

// logout button
document.getElementById("logoutBtn").addEventListener("click", function () {
    document.getElementById("logout-form").submit();
});

// -------------------------
// SEARCH NOTULEN
// -------------------------
const searchInput = document.getElementById('searchNotulen');
const tableBody   = document.getElementById('notulenTableBody');

searchInput.addEventListener('keyup', function () {
    let q = this.value;

    fetch(`/notulen/search?q=${q}`)
        .then(res => res.json())
        .then(data => {
            let rows = "";

            if (data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">
                            Tidak ada notulen ditemukan.
                        </td>
                    </tr>`;
            } else {
                data.forEach(n => {
                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-sm">${n.judul_rapat}</td>
                            <td class="px-4 py-4 text-sm">${n.tanggal}</td>
                            <td class="px-4 py-4 text-sm">${n.jam ?? '-'}</td>
                            <td class="px-4 py-4 text-sm hidden sm:table-cell">
                                ${n.topik ? n.topik.substring(0,60) : '-'}
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <span class="${n.status.toLowerCase()=='disetujui' ? 'badge-done' : 'badge-review'}">
                                    ${n.status}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <a class="text-blue-600 hover:underline"
                                    href="/notulen/${n.id}">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>`;
                });
            }

            tableBody.innerHTML = rows;
        });
});

</script>
@endpush

@endsection
