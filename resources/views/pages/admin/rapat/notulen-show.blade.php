@extends('layouts.app-tailwind')

@section('title', 'Detail Notulen - Admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-extrabold text-brand-green mb-6">Detail Notulen</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <label class="font-semibold text-brand-green">Notulis</label>
        <div class="md:col-span-3">
            <input class="w-full border rounded px-3 py-2 bg-gray-100" 
                   value="{{ $notulen->notulis->name }}" disabled>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <label class="font-semibold text-brand-green">Judul Rapat</label>
        <div class="md:col-span-3">
            <input class="w-full border rounded px-3 py-2 bg-gray-100"
                   value="{{ $notulen->judul_rapat }}" disabled>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <label class="font-semibold text-brand-green">Tanggal</label>
        <div class="md:col-span-3">
            <input class="w-full border rounded px-3 py-2 bg-gray-100" 
                   value="{{ $notulen->tanggal }}" disabled>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <label class="font-semibold text-brand-green">Jam</label>
        <div class="md:col-span-3">
            <input class="w-full border rounded px-3 py-2 bg-gray-100"
                   value="{{ $notulen->jam ?? '-' }}" disabled>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <label class="font-semibold text-brand-green">Topik</label>
        <div class="md:col-span-3">
            <textarea class="w-full border rounded px-3 py-2 bg-gray-100" rows="6" disabled>
{{ $notulen->topik }}
            </textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <label class="font-semibold text-brand-green">Status</label>
        <div class="md:col-span-3">
            <input class="w-full border rounded px-3 py-2 bg-gray-100"
                   value="{{ $notulen->status }}" disabled>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('notulen.index') }}"
           class="px-4 py-2 bg-brand-green text-white rounded hover:bg-green-700">
            Kembali
        </a>
    </div>

</div>
@endsection
