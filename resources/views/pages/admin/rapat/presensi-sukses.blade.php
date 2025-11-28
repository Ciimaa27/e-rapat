@extends('layouts.app-tailwind')

@section('title', 'Presensi Rapat')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center">

    <div class="bg-white shadow-lg border rounded-2xl p-8 text-center max-w-md">

        {{-- ICON SUKSES --}}
        <div class="flex justify-center mb-4">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                     viewBox="0 0 24 24" stroke-width="2" 
                     stroke="currentColor" class="w-14 h-14">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
        </div>

        <h1 class="text-xl font-bold text-brand-green mb-3">
            {{ $message }}
        </h1>

        <p class="text-gray-600 mb-6">
            Rapat: <span class="font-semibold">{{ $rapat->judul_rapat }}</span>
        </p>

        <a href="{{ route('pegawai.jadwal.index') }}"
           class="px-5 py-2 bg-brand-green text-white rounded-lg text-sm hover:bg-emerald-800">
            Kembali
        </a>
    </div>

</div>
@endsection
