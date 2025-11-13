@extends('layouts.app-tailwind')

@section('title', 'Daftar Rapat - E-Notulen')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Daftar Rapat</h1>
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
        {{-- SEARCH + BUTTON --}}
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
            <div class="flex-1">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Cari judul rapat..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                               focus:outline-none focus:border-brand-green"
                    >
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('residents.create') }}"
                   class="px-4 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                          hover:bg-pink-custom-hover transition whitespace-nowrap">
                    + Buat Rapat
                </a>

                <button class="px-4 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                               hover:bg-pink-custom-hover transition whitespace-nowrap">
                    Filter
                </button>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
            <table role="table" aria-label="Daftar Rapat" class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-pink-custom">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider">
                            Judul Rapat
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider">
                            Jam
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider hidden sm:table-cell">
                            Ruangan
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider hidden lg:table-cell">
                            Prioritas
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-brand-green uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($meetings ?? [] as $meeting)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap font-medium text-brand-green">
                                {{ $meeting->title ?? 'Judul' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                {{ $meeting->date ?? '20-02-2030' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                {{ $meeting->time ?? '09:00' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                {{ $meeting->room ?? 'Gedung A' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                <span class="badge {{ 'pri-' . strtolower($meeting->priority ?? 'normal') }}">
                                    {{ $meeting->priority ?? 'Normal' }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="stat-{{ strtolower($meeting->status ?? 'menunggu') }}">
                                    {{ $meeting->status ?? 'Menunggu' }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <a class="text-brand-green font-semibold hover:underline transition"
                                   href="{{ route('rapat.show', $meeting->id ?? 0) }}">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 md:px-6 py-6 text-center text-gray-500">
                                Belum ada data rapat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION SEDERHANA --}}
        <div class="flex justify-center gap-2 mt-6">
            <button class="p-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-50 transition">
                ◀
            </button>
            <button class="p-2 rounded-lg bg-pink-custom text-brand-green font-semibold hover:bg-pink-custom-hover transition">
                1
            </button>
            <button class="p-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-50 transition">
                ▶
            </button>
        </div>
    </section>
@endsection
