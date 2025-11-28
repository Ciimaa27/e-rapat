<div class="w-full bg-sidebar-gradient p-5 shadow overflow-y-auto h-full">

    {{-- LOGO / HEADER --}}
    <div class="flex items-center gap-3 mb-6 bg-white bg-opacity-60 rounded-lg p-3">
        <div class="w-14 h-14 rounded-md bg-white p-1 flex items-center justify-center text-brand-green font-bold text-lg">
            EN
        </div>
        <div>
            <div class="font-extrabold text-brand-green text-lg">E-Notulen</div>
            <div class="text-sm font-semibold text-gray-600">Sistem Rapat</div>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="space-y-3">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
               {{ request()->routeIs('dashboard') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg class="w-5 h-5 text-brand-green" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zM13 21h8V11h-8v10zm0-18v6h8V3h-8z"/>
            </svg>
            Dashboard
        </a>

        {{-- JADWAL RAPAT --}}
        <a href="{{ route('pegawai.jadwal.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
               {{ request()->routeIs('pegawai.jadwal.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.25 13.5V7.491a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25v11.25M3 16.5h18m-12-6h4.5" />
            </svg>
            Jadwal Rapat
        </a>

        {{-- ARSIP RAPAT --}}
        <a href="{{ route('pegawai.arsip.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
               {{ request()->routeIs('pegawai.arsip.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m20.25 7.5-.625 10.63A2.25 2.25 0 0117.38 20.25H6.62a2.25 2.25 0 01-2.25-2.12L3.75 7.5m8.25 3v6.75m0 0l3-3m-3 3l-3-3M3.375 7.5h17.25c.62 0 1.12-.5 1.12-1.12v-1.5c0-.62-.5-1.13-1.12-1.13H3.38c-.62 0-1.13.51-1.13 1.13v1.5c0 .62.51 1.12 1.13 1.12" />
            </svg>
            Arsip Rapat
        </a>

        {{-- TENTANG KAMI --}}
        <a href="{{ route('about') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
               {{ request()->routeIs('about') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v2.25m0 3h.008v.008H12v-.008zm0-9a9 9 0 100 18 9 9 0 000-18z" />
            </svg>
            Tentang Kami
        </a>

    </nav>

    {{-- LOGOUT --}}
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mt-8">
        @csrf
        <button type="button" id="logoutButton"
            class="inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h6A2.25 2.25 0 0118.75 5.25v13.5A2.25 2.25 0 0116.5 21h-6A2.25 2.25 0 018.25 18.75V15m-3 0l-3-3m0 0l3-3m-3 3H15" />
            </svg>
            Keluar
        </button>
    </form>

    {{-- LOGOUT MODAL --}}
    <div id="logoutModal"
         class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-80">
            <h2 class="text-lg font-bold mb-4">Konfirmasi</h2>
            <p class="mb-6">Yakin ingin keluar?</p>

            <div class="flex justify-end gap-3">
                <button id="cancelLogout"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Batal</button>

                <button id="confirmLogout"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const logoutButton = document.getElementById('logoutButton');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');

            logoutButton?.addEventListener('click', () => logoutModal.classList.remove('hidden'));
            cancelLogout?.addEventListener('click', () => logoutModal.classList.add('hidden'));
            confirmLogout?.addEventListener('click', () => document.getElementById('logoutForm').submit());
        })();
    </script>

</div>
