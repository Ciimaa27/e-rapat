@extends('layouts.app-tailwind')

@section('title', 'Tambahkan Akun - E-Notulen')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Tambahkan Akun</h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </p>
        </div>

        <div class="flex items-center gap-3">
          
        </div>
    </div>

    {{-- KOTAK BESAR PUSAT (MIRIP FIGMA) --}}
    <section class="bg-white rounded-2xl p-6 shadow border">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            {{-- PANEL ABU-ABU DI DALAM --}}
            <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">
                {{-- NAMA --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Nama
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                        >
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Email
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                        >
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- PERAN --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Peran
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <select
                            name="role"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white
                                   focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                        >
                            <option value="">Pilih peran...</option>
                            <option value="admin"    {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="notulis"  {{ old('role') == 'notulis' ? 'selected' : '' }}>Notulis</option>
                            <option value="pimpinan"  {{ old('role') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                            <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="grid grid-cols-12 items-center gap-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Password
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <input
                            type="password"
                            name="password"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                        >
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div> {{-- end panel abu-abu --}}



            {{-- TOMBOL AKSI BAWAH --}}
            <div class="flex items-center justify-between gap-3 mt-6">
                <div>
                    <a href="{{ route('users.index') }}"
                       class="px-5 py-2 rounded-lg bg-emerald-700 text-white text-sm font-semibold hover:bg-emerald-800">
                        Kembali
                    </a>
                </div>

                <div class="flex gap-3">
                    <button type="reset"
                            class="px-5 py-2 rounded-lg bg-red-700 text-white text-sm font-semibold hover:bg-red-800">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-brand-green text-white text-sm font-semibold hover:bg-emerald-800">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection
