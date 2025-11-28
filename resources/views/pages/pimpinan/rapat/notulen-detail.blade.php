@extends('layouts.app-tailwind')

@section('title', 'Detail Notulen - Pimpinan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-extrabold text-brand-green mb-6">Detail Notulen</h2>

    <form action="{{ route('pimpinan.notulen.update', $notulen->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NOTULIS --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Notulis</label>
            <div class="md:col-span-3">
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100"
                       value="{{ $notulen->notulis?->name ?? 'Tidak diketahui' }}" disabled>
            </div>
        </div>

        {{-- JUDUL --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Judul Rapat</label>
            <div class="md:col-span-3">
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100" 
                       value="{{ $notulen->judul_rapat }}" disabled>
            </div>
        </div>

        {{-- TANGGAL --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Tanggal</label>
            <div class="md:col-span-3">
                <input type="date" class="w-full border rounded px-3 py-2 bg-gray-100"
                       value="{{ $notulen->tanggal }}" disabled>
            </div>
        </div>

        {{-- JAM --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Jam</label>
            <div class="md:col-span-3">
                <input type="time" class="w-full border rounded px-3 py-2 bg-gray-100"
                       value="{{ $notulen->jam }}" disabled>
            </div>
        </div>

        {{-- TOPIK --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Topik</label>
            <div class="md:col-span-3">
                <textarea class="w-full border rounded px-3 py-2 bg-gray-100" rows="6" disabled>{{ $notulen->topik }}</textarea>
            </div>
        </div>

        {{-- STATUS UPDATE --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 items-start">
            <label class="font-semibold text-brand-green md:mt-2">Ubah Status</label>
            <div class="md:col-span-3">
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="Direview" {{ $notulen->status == 'Direview' ? 'selected' : '' }}>Direview</option>
                    <option value="Revisi" {{ $notulen->status == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="Disetujui" {{ $notulen->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                </select>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('pimpinan.notulen.index') }}"
               class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Batal
            </a>

            <button type="submit"
                class="px-4 py-2 bg-brand-green text-white rounded hover:bg-emerald-800">
                ✓ Ajukan
            </button>
        </div>

    </form>
</div>
@endsection
