@extends('layouts.app-tailwind')

@section('title', 'Tambahkan Akun - E-Notulen')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Tambahkan Akun</h1>
            <p class="text-sm text-muted mt-1">
                {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
            </p>
        </div>

        <div class="flex gap-2">
            <button class="p-2 rounded-full hover:bg-gray-100 transition" title="Notifikasi">🔔</button>
            <button class="p-2 rounded-full hover:bg-gray-100 transition" title="Profil">👤</button>
        </div>
    </div>

    {{-- KOTAK BESAR PUSAT (MIRIP FIGMA) --}}
    <section class="bg-white rounded-2xl p-6 shadow border">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            {{-- PANEL ABU-ABU DI DALAM --}}
            <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">
                {{-- NAMA (Judul Rapat di Figma) --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Judul Rapat
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

                {{-- TANGGAL (email) --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Tanggal
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

                {{-- NOTULIS (role akun) --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Notulis
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
                            <option value="pegawai"  {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            <option value="pimpinan" {{ old('role') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- JAM (password) --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Jam
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

                {{-- RUANGAN --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Ruangan
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <input
                            type="text"
                            name="room"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                        >
                    </div>
                </div>

                {{-- AGENDA --}}
                <div class="grid grid-cols-12 items-start gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                        Agenda
                    </label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <textarea rows="4" name="agenda"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                         focus:outline-none focus:ring-2 focus:ring-brand-green/60"></textarea>
                    </div>
                </div>

                {{-- PRIORITAS --}}
                <div class="grid grid-cols-12 items-center gap-3 mb-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Prioritas</label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                       focus:outline-none focus:ring-2 focus:ring-brand-green/60">
                            <option>Normal</option>
                            <option>Penting</option>
                            <option>Darurat</option>
                        </select>
                    </div>
                </div>

                {{-- STATUS (read-only display) --}}
                <div class="grid grid-cols-12 items-center gap-3">
                    <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">Status</label>
                    <span class="col-span-1 text-center">:</span>
                    <div class="col-span-12 md:col-span-8">
                        <div class="bg-gray-200 text-gray-600 rounded-md px-3 py-2 text-sm">Menunggu</div>
                    </div>
                </div>
            </div> {{-- end panel abu-abu --}}

            {{-- PRESENSI PEGAWAI + TOMBOL TAMBAH PESERTA --}}
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-brand-green">Presensi Pegawai</p>

                    {{-- INI YANG DIKASIH ID UNTUK BUKA POPUP --}}
                    <button
                        type="button"
                        id="btnTambahPeserta"
                        class="inline-flex items-center gap-2 px-3 py-2 bg-brand-green text-white text-sm font-semibold rounded-lg hover:bg-emerald-700"
                    >
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-white rounded-full text-brand-green font-bold">+</span>
                        <span>Tambah Peserta</span>
                    </button>
                </div>

                <div class="mt-3 overflow-hidden border rounded-lg">
                    <div class="bg-brand-green text-white text-sm">
                        <div class="grid grid-cols-12 gap-0">
                            <div class="col-span-3 py-2 px-4 font-semibold">Nama</div>
                            <div class="col-span-3 py-2 px-4 font-semibold">Jabatan</div>
                            <div class="col-span-4 py-2 px-4 font-semibold">email</div>
                            <div class="col-span-2 py-2 px-4 font-semibold">Presensi</div>
                        </div>
                    </div>
                    <div class="bg-white text-sm">
                        <div class="grid grid-cols-12 gap-0 border-t">
                            <div class="col-span-3 py-3 px-4">&nbsp;</div>
                            <div class="col-span-3 py-3 px-4">&nbsp;</div>
                            <div class="col-span-4 py-3 px-4">&nbsp;</div>
                            <div class="col-span-2 py-3 px-4">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========== POPUP PILIH PESERTA ========== --}}
            <div id="popupPeserta"
                 class="fixed inset-0 z-50 flex items-start justify-center pt-24 bg-black/10 hidden">
                <div class="bg-white rounded-2xl shadow-lg border w-full max-w-md">
                    {{-- search --}}
                    <div class="border-b px-4 py-3">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="cari nama peserta"
                                class="w-full pl-3 pr-9 py-2 border border-gray-300 rounded-lg text-sm
                                       focus:outline-none focus:ring-2 focus:ring-brand-green/40"
                            >
                            <span class="absolute right-3 top-2.5 text-gray-400 text-xs">
                                🔍
                            </span>
                        </div>
                    </div>

                    {{-- daftar nama (dummy) --}}
                    <div class="max-h-64 overflow-y-auto px-4 py-3 space-y-2 text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green" checked>
                            <span>Muhammadiyah</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green">
                            <span>Angga Yunanda</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green">
                            <span>Shenina Chinnamom</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green" checked>
                            <span>Radita Nabila Shofa</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green">
                            <span>Ismatul Hawa</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green">
                            <span>Naila Hafidhah</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox text-brand-green" checked>
                            <span>Hello Kitty</span>
                        </label>
                    </div>

                    {{-- tombol bawah --}}
                    <div class="border-t px-4 py-3 flex justify-end gap-2">
                        <button
                            type="button"
                            id="btnPesertaBatal"
                            class="px-4 py-1.5 rounded-md bg-red-700 text-white text-xs font-semibold hover:bg-red-800"
                        >
                            Batal
                        </button>
                        <button
                            type="button"
                            id="btnPesertaSimpan"
                            class="px-4 py-1.5 rounded-md bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700"
                        >
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
            {{-- ========== END POPUP ========== --}}

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
                            class="px-5 py-2 rounded-lg bg-brand-green text-white text-sm font-semibold hover:bg-emerald-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rotate-45" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                        <span>Ajukan</span>
                    </button>
                </div>
            </div>
        </form>
    </section>

    {{-- SCRIPT POPUP --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnOpen   = document.getElementById('btnTambahPeserta');
            const popup     = document.getElementById('popupPeserta');
            const btnBatal  = document.getElementById('btnPesertaBatal');
            const btnSimpan = document.getElementById('btnPesertaSimpan');

            function openPopup() {
                popup.classList.remove('hidden');
            }

            function closePopup() {
                popup.classList.add('hidden');
            }

            btnOpen?.addEventListener('click', openPopup);
            btnBatal?.addEventListener('click', closePopup);
            btnSimpan?.addEventListener('click', closePopup);
        });
    </script>
@endsection
