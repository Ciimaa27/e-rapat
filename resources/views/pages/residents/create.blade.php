@extends('layouts.app-tailwind')

@section('title', 'Data Rapat - E-Notulen')

@push('styles')
<style>
    .form-bg {
        background-color: #f0f0f0;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .form-bg input[type="text"],
    .form-bg input[type="date"],
    .form-bg input[type="time"],
    .form-bg select,
    .form-bg textarea {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 8px 12px;
    }

    .form-bg input[disabled] {
        background-color: #e5e7eb;
        color: #666666;
    }

    .form-bg label {
        color: #2f6b44;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-brand-green">Agenda Rapat</h1>
        <p class="text-sm text-muted">
            {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
        </p>
    </div>

    {{-- FORM RAPAT + PRESENSI --}}
    <form
        {{-- ganti route sesuai kebutuhan, misal route('rapat.store') --}}
        action="#"
        method="POST"
        class="space-y-6"
    >
        @csrf

        {{-- FORM RAPAT --}}
        <div class="form-bg p-6 rounded-lg">
            <div class="grid gap-4">
                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Judul Rapat</label>
                    <input
                        type="text"
                        name="judul"
                        class="flex-1 p-2 border rounded bg-gray-50"
                    />
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Tanggal</label>
                    <input
                        type="date"
                        name="tanggal"
                        class="w-48 p-2 border rounded bg-gray-50"
                    />
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Notulis</label>
                    <select
                        name="notulis_id"
                        class="w-48 p-2 border rounded bg-gray-50"
                    >
                        <option value="">Pilih Notulis</option>
                        {{-- @foreach ($notulis as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Jam</label>
                    <input
                        type="time"
                        name="jam"
                        class="w-48 p-2 border rounded bg-gray-50"
                    />
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Ruangan</label>
                    <input
                        type="text"
                        name="ruangan"
                        class="flex-1 p-2 border rounded bg-gray-50"
                    />
                </div>

                <div class="flex items-start">
                    <label class="w-32 text-sm font-semibold">Agenda</label>
                    <textarea
                        name="agenda"
                        rows="4"
                        class="flex-1 p-2 border rounded bg-gray-50"
                    ></textarea>
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Prioritas</label>
                    <select
                        name="prioritas"
                        class="w-48 p-2 border rounded bg-gray-50"
                    >
                        <option value="normal">Normal</option>
                        <option value="penting">Penting</option>
                        <option value="darurat">Darurat</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <label class="w-32 text-sm font-semibold">Status</label>
                    <input
                        type="text"
                        value="Menunggu"
                        disabled
                        class="w-48 p-2 border rounded bg-gray-100"
                    />
                </div>
            </div>
        </div>

        {{-- TABEL PRESENSI --}}
        <div class="mt-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-semibold text-brand-green text-sm">
                    Presensi Pegawai
                </h2>

                <button
                    type="button"
                    class="flex items-center gap-1 bg-brand-green text-white px-3 py-1.5 rounded text-xs"
                >
                    <span class="border border-white rounded-full w-4 h-4 flex items-center justify-center text-[10px]">
                        +
                    </span>
                    <span>Tambah Peserta</span>
                </button>
            </div>

            <table class="w-full text-sm border-separate border-spacing-0">
                <thead>
                    <tr class="bg-brand-green text-white">
                        <th class="py-2 px-4 text-center rounded-l-md">Nama</th>
                        <th class="py-2 px-4 text-center">Jabatan</th>
                        <th class="py-2 px-4 text-center">Email</th>
                        <th class="py-2 px-4 text-center rounded-r-md">Presensi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- contoh data, nanti diganti @foreach --}}
                    {{-- <tr>
                        <td class="py-2 px-4 text-center border-b border-gray-200">John Doe</td>
                        <td class="py-2 px-4 text-center border-b border-gray-200">Staff</td>
                        <td class="py-2 px-4 text-center border-b border-gray-200">john@example.com</td>
                        <td class="py-2 px-4 text-center border-b border-gray-200">✓</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>

        {{-- BUTTON AKSI --}}
        <div class="flex justify-end gap-2 mt-4">
            <a
                href="{{ route('residents.index') }}"
                class="px-4 py-1.5 border border-brand-green text-brand-green rounded text-sm"
            >
                Kembali
            </a>

            <button
                type="reset"
                class="px-4 py-1.5 bg-red-600 text-white rounded text-sm"
            >
                Batal
            </button>

            <button
                type="submit"
                class="flex items-center gap-1 px-4 py-1.5 bg-brand-green text-white rounded text-sm"
            >
                <span class="inline-block"></span>
                <span>Ajukan</span>
            </button>
        </div>
    </form>
@endsection
