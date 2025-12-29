@extends('layouts.app-tailwind')

@section('title', 'Edit Rapat - E-Notulen')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow border">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-brand-green">Edit Rapat</h1>
        <p class="text-sm text-gray-500">Perbarui informasi rapat</p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('rapat.update', $rapat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- JUDUL --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold mb-1">Judul Rapat</label>
                <input type="text" name="judul_rapat"
                       value="{{ old('judul_rapat', $rapat->judul_rapat) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                              focus:border-brand-green focus:outline-none"
                       required>
            </div>

            {{-- TANGGAL --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ old('tanggal', $rapat->tanggal) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                              focus:border-brand-green focus:outline-none"
                       required>
            </div>

            {{-- JAM --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Jam</label>
                <input type="time" name="jam"
                       value="{{ old('jam', $rapat->jam_formatted) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                              focus:border-brand-green focus:outline-none">
            </div>

            {{-- RUANGAN --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Ruangan</label>
                <input type="text" name="ruangan"
                       value="{{ old('ruangan', $rapat->ruangan) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                              focus:border-brand-green focus:outline-none">
            </div>

            {{-- PRIORITAS --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Prioritas</label>
                <select name="prioritas"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                               focus:border-brand-green focus:outline-none">
                    <option value="Normal" {{ $rapat->prioritas == 'Normal' ? 'selected' : '' }}>Normal</option>
                    <option value="Penting" {{ $rapat->prioritas == 'Penting' ? 'selected' : '' }}>Penting</option>
                    <option value="Darurat" {{ $rapat->prioritas == 'Darurat' ? 'selected' : '' }}>Darurat</option>
                </select>
            </div>

            {{-- STATUS --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold mb-1">Status</label>
                <select name="status"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-2
                               focus:border-brand-green focus:outline-none">
                    <option value="Menunggu" {{ $rapat->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Direview" {{ $rapat->status == 'Direview' ? 'selected' : '' }}>Direview</option>
                    <option value="Disetujui" {{ $rapat->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditunda" {{ $rapat->status == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                </select>
            </div>

        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('rapat.index') }}"
               class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-brand-green text-white rounded-lg font-semibold hover:opacity-90 transition">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection
