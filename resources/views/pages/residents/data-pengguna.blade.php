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
</style>
@endpush

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Akun Pengguna</h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        <div class="flex gap-2">
            <button class="p-2 rounded-full hover:bg-gray-100 transition" title="Notifikasi">🔔</button>
            <button class="p-2 rounded-full hover:bg-gray-100 transition" title="Profil">👤</button>
        </div>
    </div>

    <section class="bg-white rounded-lg p-4 shadow border">
        {{-- SEARCH + BUTTON TAMBAH AKUN --}}
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
            <div class="flex-1">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Cari nama atau email..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                               focus:outline-none focus:border-brand-green"
                    >
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                </div>
            </div>

            <div class="flex justify-end">
                {{-- tombol ke halaman Tambah Akun --}}
                <a
                    href="{{ route('users.create') }}"
                    class="px-5 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                           hover:bg-pink-custom-hover transition whitespace-nowrap flex items-center gap-1"
                >
                    <span>＋</span>
                    <span>Tambah Akun</span>
                </a>
            </div>
        </div>

        {{-- TABEL DATA PENGGUNA --}}
        <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
            <table role="table" aria-label="Daftar Akun Pengguna" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-pink-custom">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Nama
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Email
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Peran
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users ?? [] as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-brand-green">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                <span class="badge-role">
                                    {{ ucfirst($user->role ?? 'pegawai') }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <a
                                    href="{{ route('users.edit', $user->id) }}"
                                    class="text-blue-600 font-semibold hover:underline transition">
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 font-semibold hover:underline transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 md:px-6 py-6 text-center text-sm text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION SEDERHANA (sesuaikan kalau pakai $users->links()) --}}
        <div class="flex justify-center gap-1 mt-6 text-xs">
            <button class="px-2 py-1 rounded bg-white border border-gray-300 hover:bg-gray-50 transition">
                ‹
            </button>
            <button class="px-2 py-1 rounded bg-pink-custom text-brand-green font-semibold">
                1
            </button>
            <button class="px-2 py-1 rounded bg-white border border-gray-300 hover:bg-gray-50 transition">
                ›
            </button>
        </div>
    </section>
@endsection
