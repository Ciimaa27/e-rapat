@extends('layouts.app-tailwind')

@section('title', 'Tentang Kami - E-Notulen')

@section('content')
    <div class="space-y-8">

        {{-- KOTAK TENTANG E-NOTULEN --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green text-center mb-4">
                Tentang E-Notulen
            </h1>

            <p class="text-sm text-gray-700 leading-relaxed mb-3 text-justify">
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
        <div class="mt-4">
            <h2 class="text-xl md:text-2xl font-extrabold text-brand-green text-center mb-6">
                Tim Pengembang
            </h2>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach($team as $member)
                    <div class="bg-white border rounded-2xl shadow-sm px-6 py-8 flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center mb-4">
                            <span class="text-brand-green font-extrabold text-xl">
                                {{ strtoupper(substr($member['name'], 0, 2)) }}
                            </span>
                        </div>

                        <div class="font-semibold text-brand-green text-sm md:text-base">
                            {{ $member['name'] }}
                        </div>
                        <div class="text-xs text-gray-500 mb-2">
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
@endsection
