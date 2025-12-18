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

    <div class="flex items-center gap-3"></div>
</div>


<section class="bg-white rounded-2xl p-6 shadow border">

    {{-- PANEL DETAIL --}}
    <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">

        {{-- Judul Rapat --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Judul Rapat</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8 py-2 text-sm">
                {{ $rapat->judul_rapat }}
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Tanggal</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8 py-2 text-sm">
                {{ \Carbon\Carbon::parse($rapat->tanggal)->locale('id')->translatedFormat('d F Y') }}
            </div>
        </div>

        {{-- Jam --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Jam</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8 py-2 text-sm">
                {{ $rapat->jam }}
            </div>
        </div>

        {{-- Ruangan --}}
        <div class="grid grid-cols-12 items-center gap-3 mb-3">
            <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Ruangan</label>
            <span class="col-span-1 text-center font-bold">:</span>
            <div class="col-span-12 md:col-span-8 py-2 text-sm">
                {{ $rapat->ruangan }}
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


    {{-- PRESENSI PEGAWAI --}}
    <div class="mt-6">

        <div class="flex justify-between">

            <p class="text-sm font-semibold text-brand-green">Presensi Pegawai</p>

            {{-- TOMBOL QR PRESENSI --}}
            <button id="qrBtn"
                class="px-4 py-2 bg-emerald-700 text-white rounded-lg text-sm hover:bg-emerald-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h6v6H3V3zm12 0h6v6h-6V3zM3 15h6v6H3v-6zm12 0h6v6h-6v-6z" />
                </svg>
                QR Presensi
            </button>

        </div>


        <div class="mt-3 border rounded-lg">
            <div class="bg-brand-green text-white text-sm grid grid-cols-12">
                <div class="col-span-3 py-2 px-4 font-semibold">Nama</div>
                <div class="col-span-3 py-2 px-4 font-semibold">Jabatan</div>
                <div class="col-span-4 py-2 px-4 font-semibold">Email</div>
                <div class="col-span-2 py-2 px-4 font-semibold">Presensi</div>
            </div>

            @if ($rapat->peserta->isEmpty())
                <div class="grid grid-cols-12 text-sm bg-white border-t text-gray-500">
                    <div class="col-span-12 py-3 px-4 text-center">
                        Belum ada peserta terdaftar untuk rapat ini.
                    </div>
                </div>
            @else
                @foreach ($rapat->peserta as $peserta)
                    <div class="grid grid-cols-12 text-sm bg-white border-t">
                        <div class="col-span-3 py-3 px-4">{{ $peserta->name }}</div>
                        <div class="col-span-3 py-3 px-4">{{ ucfirst($peserta->role ?? 'pegawai') }}</div>
                        <div class="col-span-4 py-3 px-4">{{ $peserta->email }}</div>
                        <div class="col-span-2 py-3 px-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-xs text-gray-700">
                                Terdaftar
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>


    {{-- TOMBOL KEMBALI --}}
    <div class="flex justify-start mt-6">
        <a href="{{ route('rapat.index') }}"
           class="px-5 py-2 bg-emerald-700 text-white rounded-lg text-sm hover:bg-emerald-800">
            Kembali
        </a>
    </div>

</section>



{{-- =============================== --}}
{{-- MODAL QR CODE PRESENSI --}}
{{-- =============================== --}}
<div id="qrModal"
     class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center hidden z-50">

    <div class="bg-white w-72 p-6 rounded-2xl shadow-xl text-center">

        {{-- QR CODE --}}
        <div class="flex justify-center mb-3">
            <img id="qrImage" src="" alt="QR Code" class="w-40 h-40">
        </div>

        {{-- NAMA RAPAT --}}
        <p class="text-sm font-semibold text-brand-green mb-4">
            {{ $rapat->judul_rapat }}
        </p>

        {{-- TOMBOL --}}
        <button id="closeQr"
            class="px-4 py-1 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800">
            Tutup
        </button>

    </div>
</div>


@endsection



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const qrBtn   = document.getElementById("qrBtn");
    const qrModal = document.getElementById("qrModal");
    const closeQr = document.getElementById("closeQr");
    const qrImage = document.getElementById("qrImage");

    const rapatId = {{ $rapat->id }};

    // GANTI localhost → IP LAN komputer kamu
    const presensiURL = `http://192.168.1.10:8000/pegawai/pegawai/rapat/${rapatId}/presensi`;

    const qrAPI = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(presensiURL)}`;

    qrBtn.addEventListener('click', () => {
        qrImage.src = qrAPI;
        qrModal.classList.remove("hidden");
    });

    closeQr.addEventListener('click', () => {
        qrModal.classList.add("hidden");
    });

});
</script>
@endpush
