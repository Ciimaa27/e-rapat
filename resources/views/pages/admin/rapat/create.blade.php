@extends('layouts.app-tailwind')

@section('title', 'Agenda Rapat - E-Notulen')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-brand-green">Buat Rapat Baru</h1>
        <p class="text-sm text-muted mt-1">
            {{ now()->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
        </p>
    </div>

    <div class="flex items-center gap-3">
    </div>
</div>

{{-- FORM --}}
<section class="bg-white rounded-2xl p-6 shadow border">
    <form action="{{ route('rapat.store') }}" method="POST">
        @csrf
        {{-- PANEL FORM --}}
        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">

            {{-- Judul Rapat --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Judul Rapat
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <input
                        type="text"
                        name="judul_rapat"
                        value="{{ old('judul_rapat') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-brand-green/60"
                    >
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Tanggal
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-brand-green/60"
                    >
                </div>
            </div>

            {{-- NOTULIS (pilih dari user yang rolenya notulis) --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Notulis
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <select
                        name="notulis_id"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-brand-green/60"
                    >
                        <option value="">Pilih notulis...</option>

                        @foreach ($notulisList as $notulis)
                            <option value="{{ $notulis->id }}"
                                {{ old('notulis_id') == $notulis->id ? 'selected' : '' }}>
                                {{ $notulis->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('notulis_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- JAM --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Jam
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <input
                        type="time"
                        name="jam"
                        value="{{ old('jam') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-brand-green/60"
                    >
                </div>
            </div>



            {{-- Ruangan --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Ruangan
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <input
                        type="text"
                        name="ruangan"
                        value="{{ old('ruangan') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-brand-green/60"
                    >
                </div>
            </div>

            {{-- Prioritas --}}
            <div class="grid grid-cols-12 items-center gap-3 mb-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Prioritas
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <select
                        name="prioritas"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-brand-green/60"
                    >
                        <option value="Normal">Normal</option>
                        <option value="Penting">Penting</option>
                        <option value="Darurat">Darurat</option>
                    </select>
                </div>
            </div>

            {{-- Status --}}
            <div class="grid grid-cols-12 items-center gap-3">
                <label class="col-span-4 md:col-span-3 text-sm font-semibold text-brand-green">
                    Status
                </label>

                <span class="col-span-1 flex items-center justify-center text-brand-green font-semibold">
                    :
                </span>

                <div class="col-span-12 md:col-span-8">
                    <input type="hidden" name="status" value="Menunggu">
                </div>
            </div>

        </div>

        {{-- Presensi --}}
        <div class="mt-6">
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-brand-green">Presensi Pegawai</p>

                <button
                    type="button"
                    id="btnTambahPeserta"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-brand-green text-white rounded-lg"
                >
                    <span class="bg-white w-6 h-6 flex items-center justify-center rounded-full text-brand-green font-bold">
                        +
                    </span>
                    Tambah Peserta
                </button>
            </div>

            <div class="mt-3 border rounded-lg">
                <div class="bg-brand-green text-white text-sm grid grid-cols-12">
                    <div class="col-span-3 py-2 px-4 font-semibold">Nama</div>
                    <div class="col-span-3 py-2 px-4 font-semibold">Jabatan</div>
                    <div class="col-span-4 py-2 px-4 font-semibold">Email</div>
                    <div class="col-span-2 py-2 px-4 font-semibold">Presensi</div>
                </div>

                {{-- body yang akan diisi via JS --}}
                <div id="presensiBody">
                    <div id="presensiEmptyRow"
                        class="grid grid-cols-12 text-sm bg-white border-t text-gray-400">
                        <div class="col-span-12 py-3 px-4 text-center">
                            Belum ada peserta dipilih.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BUTTON BAWAH --}}
        <div class="flex justify-between mt-6">
            <a
                href="{{ route('rapat.index') }}"
                class="px-5 py-2 bg-emerald-700 text-white rounded-lg text-sm hover:bg-emerald-800"
            >
                Kembali
            </a>

            <div class="flex gap-3">
                {{-- BATAL --}}
                <button
                    type="button"
                    id="btnBatalForm"
                    class="px-5 py-2 bg-red-700 text-white rounded-lg text-sm hover:bg-red-800"
                >
                    Batal
                </button>

                {{-- AJUKAN --}}
                <button
                    type="submit"
                    id="btnAjukanForm"
                    class="px-5 py-2 bg-brand-green text-white rounded-lg text-sm flex items-center gap-2 hover:bg-emerald-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rotate-45" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                    </svg>
                    Ajukan
                </button>
            </div>
        </div>

    </form>
</section>

{{-- ================================ --}}
{{-- POPUP PESERTA --}}
{{-- ================================ --}}
<div id="popupPeserta" class="hidden fixed inset-0 bg-black/10 flex items-start justify-center pt-24 z-50">
    <div class="bg-white border rounded-2xl shadow-lg w-full max-w-md">

        {{-- Search --}}
        <div class="border-b p-4">
            <input
                type="text"
                id="searchPeserta"
                placeholder="cari nama / email"
                class="w-full border rounded-lg px-3 py-2 text-sm"
            >
        </div>

        {{-- List Peserta dari data pengguna --}}
        <div id="pesertaList" class="max-h-64 overflow-y-auto p-4 space-y-2 text-sm">
            @foreach ($pegawaiList as $p)
                <label
                    class="flex items-center gap-2 cursor-pointer"
                    data-text="{{ strtolower($p->name . ' ' . $p->email . ' ' . ($p->role ?? '')) }}"
                >
                    <input type="checkbox"
                           class="pesertaCheckbox"
                           data-id="{{ $p->id }}"
                           data-name="{{ $p->name }}"
                           data-email="{{ $p->email }}"
                           data-jabatan="{{ ucfirst($p->role ?? 'Pegawai') }}">
                    <span>
                        {{ $p->name }}
                        <span class="text-gray-400 text-xs">({{ $p->email }})</span>
                    </span>
                </label>
            @endforeach

            @if ($pegawaiList->isEmpty())
                <p class="text-xs text-gray-500">Belum ada data pegawai untuk dijadikan peserta.</p>
            @endif
        </div>

        <div class="border-t p-4 flex justify-end gap-2">
            <button
                id="btnPesertaBatal"
                type="button"
                class="px-4 py-1.5 bg-red-700 text-white rounded"
            >
                Batal
            </button>

            <button
                id="btnPesertaSimpan"
                type="button"
                class="px-4 py-1.5 bg-blue-600 text-white rounded"
            >
                Simpan
            </button>
        </div>
    </div>
</div>

{{-- ================================ --}}
{{-- POPUP KONFIRMASI BATAL --}}
{{-- ================================ --}}
<div id="popupConfirmBatal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-sm p-6">
        <h2 class="text-lg font-bold text-brand-green mb-3">Konfirmasi</h2>
        <p class="text-sm text-gray-600 mb-6">
            Yakin ingin membatalkan? Semua input akan dikosongkan.
        </p>

        <div class="flex justify-end gap-2">
            <button
                id="cancelBatal"
                class="px-4 py-2 bg-gray-300 text-sm rounded-lg hover:bg-gray-400"
            >
                Tidak jadi
            </button>

            <button
                id="confirmBatal"
                class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700"
            >
                Ya, batalkan
            </button>
        </div>
    </div>
</div>



{{-- ================================ --}}
{{-- SCRIPT --}}
{{-- ================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    // ======================
    // Popup Peserta
    // ======================
    const btnTambahPeserta = document.getElementById('btnTambahPeserta');
    const popupPeserta     = document.getElementById('popupPeserta');
    const btnPesertaBatal  = document.getElementById('btnPesertaBatal');
    const btnPesertaSimpan = document.getElementById('btnPesertaSimpan');

    const searchPeserta = document.getElementById('searchPeserta');
    const pesertaList   = document.getElementById('pesertaList');

    const presensiBody      = document.getElementById('presensiBody');
    const presensiEmptyRow  = document.getElementById('presensiEmptyRow');

    // buka / tutup popup
    btnTambahPeserta.addEventListener('click', () => popupPeserta.classList.remove('hidden'));
    btnPesertaBatal.addEventListener('click', () => popupPeserta.classList.add('hidden'));

    // filter peserta di popup
    if (searchPeserta && pesertaList) {
        const items = pesertaList.querySelectorAll('label[data-text]');
        searchPeserta.addEventListener('keyup', function () {
            const q = this.value.toLowerCase();
            items.forEach(item => {
                const text = item.getAttribute('data-text');
                if (!text) return;
                item.classList.toggle('hidden', !text.includes(q));
            });
        });
    }

    // Simpan peserta terpilih ke tabel presensi
    btnPesertaSimpan.addEventListener('click', () => {
        const checkboxes = document.querySelectorAll('.pesertaCheckbox:checked');

        if (checkboxes.length === 0) {
            popupPeserta.classList.add('hidden');
            return;
        }

        // kalau ada row kosong, hapus
        if (presensiEmptyRow) {
            presensiEmptyRow.remove();
        }

        checkboxes.forEach(cb => {
            const id      = cb.dataset.id;
            const name    = cb.dataset.name;
            const email   = cb.dataset.email;
            const jabatan = cb.dataset.jabatan || 'Pegawai';

            // Hindari duplikat peserta
            if (document.querySelector(`[data-presensi-id="${id}"]`)) {
                return;
            }

            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 text-sm bg-white border-t items-center';
            row.setAttribute('data-presensi-id', id);

            row.innerHTML = `
                <div class="col-span-3 py-3 px-4">${name}</div>
                <div class="col-span-3 py-3 px-4">${jabatan}</div>
                <div class="col-span-4 py-3 px-4">${email}</div>
                <div class="col-span-2 py-3 px-4">
                    <input type="hidden" name="peserta_ids[]" value="${id}">
                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-xs text-gray-600">
                        Terdaftar
                    </span>
                    <button type="button"
                            class="ml-2 text-xs text-red-600 hover:underline btnHapusPeserta">
                        Hapus
                    </button>
                </div>
            `;

            presensiBody.appendChild(row);
        });

        // bersihkan centang
        document.querySelectorAll('.pesertaCheckbox').forEach(cb => cb.checked = false);

        popupPeserta.classList.add('hidden');
    });

    // Hapus peserta dari presensi (event delegation)
    presensiBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('btnHapusPeserta')) {
            const row = e.target.closest('[data-presensi-id]');
            if (row) {
                row.remove();
            }

            // Kalau semua row sudah habis, tampilkan lagi row kosong
            if (!presensiBody.querySelector('[data-presensi-id]')) {
                const empty = document.createElement('div');
                empty.id = 'presensiEmptyRow';
                empty.className = 'grid grid-cols-12 text-sm bg-white border-t text-gray-400';
                empty.innerHTML = `
                    <div class="col-span-12 py-3 px-4 text-center">
                        Belum ada peserta dipilih.
                    </div>
                `;
                presensiBody.appendChild(empty);
            }
        }
    });

    // ======================
    // Popup Konfirmasi Batal
    // ======================
    const btnBatalForm      = document.getElementById('btnBatalForm');
    const popupConfirmBatal = document.getElementById('popupConfirmBatal');
    const cancelBatal       = document.getElementById('cancelBatal');
    const confirmBatal      = document.getElementById('confirmBatal');

    btnBatalForm.addEventListener('click', () => popupConfirmBatal.classList.remove('hidden'));
    cancelBatal.addEventListener('click', () => popupConfirmBatal.classList.add('hidden'));
    confirmBatal.addEventListener('click', () => {
        form.reset();
        presensiBody.innerHTML = '';
        const empty = document.createElement('div');
        empty.id = 'presensiEmptyRow';
        empty.className = 'grid grid-cols-12 text-sm bg-white border-t text-gray-400';
        empty.innerHTML = `
            <div class="col-span-12 py-3 px-4 text-center">
                Belum ada peserta dipilih.
            </div>
        `;
        presensiBody.appendChild(empty);
        popupConfirmBatal.classList.add('hidden');
    });

    // ======================
    // Tombol Ajukan → submit form
    // ======================
    const btnAjukanForm = document.getElementById('btnAjukanForm');
    btnAjukanForm.addEventListener('click', function () {
        form.submit();
    });
});
</script>
@endsection