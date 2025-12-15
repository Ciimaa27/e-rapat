@extends('layouts.app-tailwind')

@section('title', 'Tentang kami - E-Notulen')

@section('content')

<div class="h-screen overflow-hidden flex flex-col justify-center">
    <div class="space-y-4">

        {{-- KOTAK TENTANG E-NOTULEN --}}
        <div class="bg-white border rounded-lg shadow-sm p-4">
            <h1 class="text-xl md:text-2xl font-extrabold text-brand-green text-center mb-3">
                Tentang E-Notulen
            </h1>

            <p class="text-sm text-gray-700 leading-relaxed mb-2 text-justify">
                <strong>E-Notulen</strong> adalah aplikasi berbasis web yang digunakan untuk
                mencatat, menyimpan, dan mengelola hasil rapat di lingkungan Pemerintah Kota.
                Sistem ini dirancang untuk memastikan proses pencatatan notulen menjadi lebih
                cepat, terstruktur, dan mudah diakses oleh setiap pihak yang berkepentingan.
            </p>

            <p class="text-sm text-gray-700 leading-relaxed text-justify">
                Melalui E-Notulen, seluruh dokumen rapat dapat tersimpan secara aman dalam
                satu platform terpusat, sehingga memudahkan proses distribusi, pengarsipan,
                dan penelusuran data rapat kapan saja.
            </p>
        </div>

        {{-- TIM PENGEMBANG --}}
        <div>
            <h2 class="text-lg md:text-xl font-extrabold text-brand-green text-center mb-4">
                Tim Pengembang
            </h2>

            <div class="grid gap-4 md:grid-cols-3">
                @foreach($team as $member)
                    <div class="bg-white border rounded-2xl shadow-sm px-4 py-5 flex flex-col items-center text-center">

                        {{-- FOTO TIM --}}
                        <div class="w-16 h-16 rounded-full overflow-hidden mb-3">
                            <img
                                src="{{ asset($member['photo']) }}"
                                alt="{{ $member['name'] }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="font-semibold text-brand-green text-sm">
                            {{ $member['name'] }}
                        </div>

                        <div class="text-xs text-gray-500 mb-1">
                            {{ $member['role'] }}
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            {{ $member['desc'] }}
                        </p>

                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
