@extends('layouts.app-tailwind')

@section('title', 'Notulen Rapat - E-Notulen')

@push('styles')
<style>
    /* status badge khusus notulen */
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
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Notulen rapat</h1>
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
        {{-- SEARCH + FILTER --}}
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

            {{-- hanya tombol Filter, tanpa "Buat Rapat" --}}
            <div class="flex justify-end">
                <button
                    class="px-5 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                           hover:bg-pink-custom-hover transition whitespace-nowrap flex items-center gap-1"
                >
                    <span>☰</span>
                    <span>Filter</span>
                </button>
            </div>
        </div>

        {{-- TABEL NOTULEN --}}
        <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
            <table role="table" aria-label="Daftar Notulen Rapat" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-pink-custom">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Judul Rapat
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Tanggal
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Jam
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green hidden sm:table-cell">
                            Agenda
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Status
                        </th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-brand-green">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($notulens ?? [] as $note)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-brand-green">
                                {{ $note->title ?? 'Persiapan Uji Coba Sistem e-Notulen' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                {{ $note->date ?? '21-02-2030' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                {{ $note->time ?? '09:00' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell">
                                {{ $note->agenda ?? 'Lorem ipsum dolor sit amet, consectetur adipisi elit, sed...' }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                @php
                                    $status   = strtolower($note->status ?? 'direview');
                                    $badgeCls = $status === 'selesai' ? 'badge-done' : 'badge-review';
                                @endphp

                                <span class="{{ $badgeCls }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                <a
                                    class="text-blue-600 font-semibold hover:underline transition"
                                    href="{{ route('notulen.show', $note->id ?? 0) }}"
                                >
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 md:px-6 py-6 text-center text-sm text-gray-500">
                                Belum ada notulen rapat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION SEDERHANA (dummy) --}}
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
