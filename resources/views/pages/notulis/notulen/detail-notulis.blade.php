@extends('layouts.app-tailwind')

@section('title', 'Agenda Rapat - E-Notulen')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Detail Rapat</h1>
        <p class="text-sm text-muted mt-1">
            {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
        </p>
    </div>

    <div class="flex items-center gap-3">
        <button class="p-2 rounded-md text-brand-green hover:bg-gray-100 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 22a2 2 0 002-2H10a2 2 0 002 2zM18 8a6 6 0 10-12 0v5l-2 2v1h16v-1l-2-2V8z"/>
            </svg>
        </button>

        <button class="p-2 rounded hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 11-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0Z" />
            </svg>
        </button>
    </div>
</div>

<section class="bg-white rounded-2xl p-6 shadow border">

    {{-- PANEL DETAIL --}}
    <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">

        {{-- Judul Rapat --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Judul Rapat</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <div class="py-2 text-sm">{{ $rapat->judul_rapat }}</div>
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Tanggal</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <div class="py-2 text-sm">
                    {{ \Carbon\Carbon::parse($rapat->tanggal)->locale('id')->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        {{-- Jam --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Jam</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <div class="py-2 text-sm">{{ $rapat->jam }}</div>
            </div>
        </div>

        {{-- Ruangan --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Ruangan</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <div class="py-2 text-sm">{{ $rapat->ruangan }}</div>
            </div>
        </div>

        {{-- Prioritas --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Prioritas</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <span class="badge pri-{{ strtolower($rapat->prioritas) }}">
                    {{ ucfirst($rapat->prioritas) }}
                </span>
            </div>
        </div>

        {{-- Status --}}
        <div class="grid grid-cols-12 items-center gap-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Status</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8">
                <span class="stat-{{ strtolower($rapat->status) }}">
                    {{ ucfirst($rapat->status) }}
                </span>
            </div>
        </div>

    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="flex justify-start mt-6">
        <a href="{{ route('notulis.agenda.index') }}"
           class="px-5 py-2 bg-emerald-700 text-white rounded-lg text-sm hover:bg-emerald-800">
            Kembali
        </a>
    </div>

</section>

@endsection
