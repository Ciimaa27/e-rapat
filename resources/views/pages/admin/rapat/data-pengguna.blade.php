@extends('layouts.app-tailwind')

@section('title', 'Data Pengguna - E-Notulen')

@push('styles')
<style>
    .badge-role {
        background:#e5e7eb;
        color:#111827;
        font-weight:600;
        padding:4px 10px;
        border-radius:9999px;
        font-size:11px;
    }

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
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Akun Pengguna</h1>
        <p class="text-sm text-muted mt-1">
            {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
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
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-5 h-5 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<section class="bg-white rounded-lg p-4 shadow border">

    {{-- SEARCH + BUTTON TAMBAH --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
        <div class="flex-1">
            <div class="relative">
                <input type="text" id="searchUser"
                       placeholder="Cari nama atau email..."
                       class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                              focus:outline-none focus:border-brand-green">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('users.create') }}"
               class="px-5 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                      hover:bg-pink-custom-hover transition flex items-center gap-1">
                <span>＋</span> Tambah Akun
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 table-divider">
            <thead class="bg-pink-custom">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Peran</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-brand-green">Aksi</th>
                </tr>
            </thead>

            <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-sm font-medium text-brand-green">{{ $user->name }}</td>
                    <td class="px-4 py-4 text-sm">{{ $user->email }}</td>
                    <td class="px-4 py-4 text-sm">
                        <span class="badge-role">{{ ucfirst($user->role ?? 'pegawai') }}</span>
                    </td>
                    <td class="px-4 py-4 text-sm space-x-2">
                        <a href="{{ route('users.edit', $user->id) }}"
                           class="text-blue-600 font-semibold hover:underline">
                           Edit
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                        Belum ada data pengguna.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>

@push('scripts')
<script>
// ------------------------------
// DROPDOWN PROFILE
// ------------------------------
const profileBtn = document.getElementById("profileBtn");
const profileDropdown = document.getElementById("profileDropdown");

profileBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    profileDropdown.classList.toggle("hidden");
});

// klik di luar → tutup dropdown
document.addEventListener("click", function (e) {
    if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
        profileDropdown.classList.add("hidden");
    }
});

// tombol logout
document.getElementById("logoutBtn").addEventListener("click", function () {
    document.getElementById("logout-form").submit();
});

// ------------------------------
// SEARCH REALTIME
// ------------------------------
const input = document.getElementById('searchUser');
const tableBody = document.getElementById('userTableBody');

input.addEventListener('keyup', function () {
    let q = this.value;

    fetch(`/data-pengguna/search?q=${q}`)
        .then(res => res.json())
        .then(data => {
            let rows = '';

            if (data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>`;
            } else {
                data.forEach(u => {
                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-sm font-medium text-brand-green">${u.name}</td>
                            <td class="px-4 py-4 text-sm">${u.email}</td>
                            <td class="px-4 py-4 text-sm">
                                <span class="badge-role">${u.role}</span>
                            </td>
                            <td class="px-4 py-4 text-sm space-x-2">
                                <a class="text-blue-600 hover:underline"
                                   href="/data-pengguna/${u.id}/edit">Edit</a>

                                <form method="POST" action="/data-pengguna/${u.id}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
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
