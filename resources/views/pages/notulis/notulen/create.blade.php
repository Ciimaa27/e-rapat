@extends('layouts.app-tailwind')

@section('title', 'Buat Notulen - Notulis')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-extrabold text-brand-green mb-6">Buat Notulen</h2>

    <form action="{{ route('notulis.notulen.store') }}" method="POST">
        @csrf

        {{-- NOTULIS (HANYA DITAMPILKAN, DISABLE) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Notulis
            </label>
            <div class="md:col-span-3">
                <input
                    type="text"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700"
                    value="{{ auth()->user()->name ?? 'Nama Notulis' }}"
                    disabled
                >
                {{-- kalau mau ikut disimpan, pakai hidden input --}}
                <input type="hidden" name="notulis_name" value="{{ auth()->user()->name ?? '' }}">
            </div>
        </div>

        {{-- JUDUL RAPAT --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Judul Rapat
            </label>
            <div class="md:col-span-3">
                <input
                    type="text"
                    name="title"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Masukkan judul rapat..."
                >
            </div>
        </div>

        {{-- TANGGAL --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Tanggal
            </label>
            <div class="md:col-span-3">
                <input
                    type="date"
                    name="date"
                    class="w-full border rounded px-3 py-2"
                >
            </div>
        </div>

        {{-- JAM RAPAT --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Jam
            </label>
            <div class="md:col-span-3">
                <input
                    type="time"
                    name="jam"
                    class="w-full border rounded px-3 py-2"
                >
            </div>
        </div>

        {{-- TOPIK / ISI NOTULEN --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Topik
            </label>
            <div class="md:col-span-3">
                <textarea
                    name="content"
                    rows="6"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Tuliskan ringkasan rapat, keputusan, dan tindak lanjut di sini..."
                ></textarea>
            </div>
        </div>

        {{-- STATUS (FIX: DIREVIEW SAJA, TIDAK BISA DIKLIK) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 items-start">
            <label class="font-semibold text-brand-green md:mt-2">
                Status
            </label>
            <div class="md:col-span-3">
                <div class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700">
                    Direview
                </div>
                {{-- tetap dikirim ke backend --}}
                <input type="hidden" name="status" value="Direview">
            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-end gap-3">
            <a
                href="{{ route('notulis.notulen.index') }}"
                class="inline-flex items-center px-4 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 rounded bg-brand-green text-white font-semibold hover:bg-emerald-800 transition"
            >
                ✓ Ajukan
            </button>
        </div>
    </form>
</div>
@endsection
