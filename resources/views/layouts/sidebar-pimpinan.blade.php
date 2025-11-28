<div class="w-full bg-sidebar-gradient p-5 shadow overflow-y-auto h-screen rounded-r-2xl">

    {{-- LOGO --}}
    <div class="flex items-center gap-3 mb-6 bg-white bg-opacity-60 rounded-lg p-3">
        <div class="w-14 h-14 rounded-md bg-white p-1 flex items-center justify-center text-brand-green font-bold text-lg">
            EN
        </div>
        <div>
            <div class="font-extrabold text-brand-green text-lg">E-Notulen</div>
            <div class="text-sm font-semibold text-gray-600">Sistem Rapat</div>
        </div>
    </div>

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

        {{-- AGENDA RAPAT --}}
        <a href="{{ route('pimpinan.rapat.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{ request()->routeIs('pimpinan.rapat.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 3v2.25m10.5-2.25V5.25M3.375 9h17.25M4.5 6.75h15a2.25 2.25 0 012.25 2.25v9.75A2.25 2.25 0 0119.5 21H4.5A2.25 2.25 0 012.25 18.75V9a2.25 2.25 0 012.25-2.25Z" />
            </svg>
            Agenda Rapat
        </a>

        {{-- NOTULEN RAPAT --}}
        <a href="{{ route('pimpinan.notulen.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{ request()->routeIs('pimpinan.notulen.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-3.375a3.375 3.375 0 00-3.375-3.375H12.75A1.125 1.125 0 0111.625 6.375V3A3.375 3.375 0 008.25 3H5.625A1.125 1.125 0 004.5 4.125V19.875A1.125 1.125 0 005.625 21H18.375A1.125 1.125 0 0019.5 19.875V14.25Z" />
            </svg>
            Notulen Rapat
        </a>

        {{-- ARSIP --}}
        <a href="{{ route('pimpinan.arsip.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{ request()->routeIs('pimpinan.arsip.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.375 7.5h17.25c.62 0 1.125-.5 1.125-1.125v-1.5c0-.62-.505-1.125-1.125-1.125H3.375c-.62 0-1.125.505-1.125 1.125v1.5c0 .62.505 1.125 1.125 1.125zm1.5 0l.63 10.63a2.25 2.25 0 002.25 2.12h8.49a2.25 2.25 0 002.25-2.12L19.125 7.5M12 12v6m0 0l-3-3m3 3l3-3" />
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
                      d="M12 8.25h.008v.008H12V8.25zm0 3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
</div>


{{-- POPUP LOGOUT --}}
<div id="logoutModal"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-80">
        <h2 class="text-lg font-bold mb-4">Konfirmasi</h2>
        <p class="mb-6">Yakin ingin keluar?</p>

        <div class="flex justify-end gap-3">
            <button id="cancelLogout"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                Batal
            </button>

            <button id="confirmLogout"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Keluar
            </button>
        </div>
    </div>
</div>


<script>
    (function () {
        const logoutButton  = document.getElementById('logoutButton');
        const logoutModal   = document.getElementById('logoutModal');
        const cancelLogout  = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');
        const logoutForm    = document.getElementById('logoutForm');

        logoutButton?.addEventListener('click', () => {
            logoutModal.classList.remove('hidden');
        });

        cancelLogout?.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
        });

        confirmLogout?.addEventListener('click', () => {
            logoutForm.submit();
        });
    })();
</script>
