@extends('layouts.app-tailwind')

@section('title', 'Detail Notulen - Notulis')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-extrabold text-brand-green mb-6">
        Detail Notulen
    </h2>

    {{-- Judul Rapat --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <span class="font-semibold text-brand-green md:mt-2">Judul Rapat</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-50">
                {{ $notulen->judul_rapat }}
            </div>
        </div>
    </div>

    {{-- Tanggal --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <span class="font-semibold text-brand-green md:mt-2">Tanggal</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-50">
                {{ \Carbon\Carbon::parse($notulen->tanggal)->isoFormat('DD MMMM YYYY') }}
            </div>
        </div>
    </div>

    {{-- Jam --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <span class="font-semibold text-brand-green md:mt-2">Jam</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-50">
                {{ $notulen->jam ?? '-' }}
            </div>
        </div>
    </div>

    {{-- Notulis --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <span class="font-semibold text-brand-green md:mt-2">Notulis</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-50">
                {{ $notulen->notulis->name ?? auth()->user()->name }}
            </div>
        </div>
    </div>

    {{-- Isi Notulen --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <span class="font-semibold text-brand-green md:mt-2">Isi Notulen</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-50 whitespace-pre-line">
                {{ $notulen->topik }}
            </div>
        </div>
    </div>

    {{-- Status --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <span class="font-semibold text-brand-green md:mt-2">Status</span>
        <div class="md:col-span-3">
            <div class="border rounded px-3 py-2 bg-gray-100 text-gray-700">
                {{ $notulen->status }}
            </div>
        </div>
    </div>

    <div class="flex justify-start">
        <a href="{{ route('notulis.notulen.index') }}"
           class="px-4 py-2 rounded bg-emerald-700 text-white font-semibold hover:bg-emerald-800 transition">
            Kembali
        </a>
    </div>
</div>
@endsection
