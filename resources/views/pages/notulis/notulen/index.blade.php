@extends('layouts.app-tailwind')

@section('title', 'Agenda Rapat - Notulis')

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

    .table-divider tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .table-divider tbody tr:last-child {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: .25rem .5rem;
        border-radius: .5rem;
        font-weight: 600;
    }

    .pri-tinggi {
        background: #fde68a;
        color: #b45309;
    }

    .pri-normal {
        background: #d1fae5;
        color: #065f46;
    }

    .stat-disetujui {
        background: #ecfdf5;
        color: #065f46;
        padding: .25rem .5rem;
        border-radius: .375rem;
        font-weight: 600;
    }

    .stat-draft {
        background: #fff7ed;
        color: #92400e;
        padding: .25rem .5rem;
        border-radius: .375rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="p-5 mb-6">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-brand-green">
                Agenda Rapat
            </h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </p>
        </div>

        {{-- PROFIL --}}
        <div class="flex items-center gap-3">
            <div class="relative">
                <button
                    id="profileBtn"
                    class="p-2 rounded hover:bg-gray-100 transition"
                    title="Profil"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                {{-- DROPDOWN --}}
                <div
                    id="profileDropdown"
                    class="absolute right-0 mt-3 w-56 bg-white shadow-lg border rounded-xl p-4 hidden z-20"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-brand-green">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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
                    <form
                        id="logout-form"
                        action="{{ route('logout') }}"
                        method="POST"
                        class="mt-4"
                    >
                        @csrf
                        <button
                            type="button"
                            id="logoutBtn"
                            class="w-full flex items-center justify-between text-sm text-brand-green px-2 py-2 rounded-lg hover:bg-gray-50"
                        >
                            Logout
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<section class="bg-white rounded-lg p-4 shadow border">

    {{-- SEARCH + FILTER --}}
<div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
    <div class="flex-1">
        <div class="relative">
            <input
                type="text"
                id="searchRapat"
                placeholder="Cari judul rapat..."
                class="w-full pl-10 pr-4 py-2 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm
                       focus:outline-none focus:border-brand-green"
            >
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </span>
        </div>
    </div>

    <div class="flex gap-2 relative">
        <button id="filterBtn"
            class="px-4 py-2 bg-pink-custom text-brand-green font-semibold rounded-lg text-sm
                   hover-pink-custom-hover transition whitespace-nowrap flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5
                         m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5
                         m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0
                         m-9.75 0h9.75" />
            </svg>
            <span>Filter</span>
        </button>

        {{-- DROPDOWN FILTER --}}
        <div id="filterDropdown"
             class="absolute right-0 top-11 bg-white border rounded-lg shadow-md w-44 hidden z-30">
            <button class="filter-item w-full text-left px-4 py-2 hover:bg-gray-100"
                    data-filter="Disetujui">
                Disetujui
            </button>
            <button class="filter-item w-full text-left px-4 py-2 hover:bg-gray-100"
                    data-filter="Draft">
                Draft
            </button>
        </div>
    </div>
</div>

    <div class="border-2 border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
        <table role="table" aria-label="Daftar Rapat" class="min-w-full divide-y divide-gray-200 text-sm table-divider">
            <thead class="bg-pink-custom">
                <tr>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green rounded-tl-lg">Judul Rapat</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Tanggal</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Jam</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green hidden sm:table-cell">Ruangan</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green hidden lg:table-cell">Prioritas</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green">Status</th>
                    <th class="px-4 md:px-6 py-3 text-left text-sm font-bold text-brand-green rounded-tr-lg">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rapats as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap font-medium text-brand-green">
                            {{ $item->judul_rapat }}
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD MMMM YYYY') }}
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::createFromFormat('H:i:s', $item->jam)->format('H:i') }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden sm:table-cell">{{ $item->ruangan }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                            <span class="badge {{ 'pri-' . strtolower($item->prioritas) }}">
                                {{ ucfirst($item->prioritas) }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            <span class="stat-{{ strtolower($item->status) }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap flex flex-col gap-1">
                            <a href="{{ route('notulis.agenda.show', $item->id) }}" class="text-blue-600 font-semibold hover:underline transition">
                                Lihat Detail
                            </a>
                            <a href="{{ route('notulis.notulen.create', $item->id) }}" class="text-green-600 font-semibold hover:underline transition">
                                Buat Notulen
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
</section>
@endsection
