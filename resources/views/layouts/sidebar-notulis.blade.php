<div class="w-full bg-sidebar-gradient p-5 shadow overflow-y-auto h-screen">

    {{-- LOGO BESAR DI ATAS --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('foto/logo.png') }}" 
             alt="Logo E-Notulen" 
             class="w-32 h-32 object-contain">
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

        {{-- AGENDA RAPAT --}}
        <a href="{{ route('notulis.agenda.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{
                request()->routeIs('notulis.agenda.*')
                || request()->routeIs('notulis.notulen.create')
                ? 'bg-white/40'
                : 'hover:bg-white/50'
           }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
            </svg>
            Agenda Rapat
        </a>

        {{-- NOTULEN RAPAT --}}
        <a href="{{ route('notulis.notulen.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{
                request()->routeIs('notulis.notulen.index')
                || request()->routeIs('notulis.notulen.show')
                ? 'bg-white/40'
                : 'hover:bg-white/50'
           }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            Notulen Rapat
        </a>

        {{-- ARSIP --}}
        <a href="{{ route('notulis.arsip.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{ request()->routeIs('notulis.arsip.*') ? 'bg-white/40' : 'hover:bg-white/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            Arsip Rapat
        </a>

        {{-- TENTANG --}}
        <a href="{{ route('about') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
           {{ request()->routeIs('about') ? 'bg-white/40' : 'hover:bg-white/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            Tentang Kami
        </a>

    </nav>

    {{-- PEMBATAS --}}
    <hr class="my-4 border-t border-gray-200">

    {{-- LOGOUT --}}
    <form id="logoutFormNotulis" action="{{ route('logout') }}" method="POST" class="mt-8">
        @csrf
        <button type="button" id="logoutButtonNotulis"
            class="inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-700 transition">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6
                        a2.25 2.25 0 0 1 2.25 2.25v13.5
                        A2.25 2.25 0 0 1 16.5 21h-6
                        a2.25 2.25 0 0 1-2.25-2.25V15
                        m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>

            Keluar
        </button>
    </form>


    {{-- LOGOUT CONFIRMATION MODAL --}}
    <div id="logoutModalNotulis" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-80">
            <h2 class="text-lg font-bold mb-4">Konfirmasi</h2>
            <p class="mb-6">Yakin ingin keluar?</p>

            <div class="flex justify-end gap-3">
                <button id="cancelLogoutNotulis" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Batal</button>

                <button id="confirmLogoutNotulis" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const logoutButtonNotulis = document.getElementById('logoutButtonNotulis');
            const logoutModalNotulis  = document.getElementById('logoutModalNotulis');
            const cancelLogoutNotulis = document.getElementById('cancelLogoutNotulis');
            const confirmLogoutNotulis = document.getElementById('confirmLogoutNotulis');

            logoutButtonNotulis?.addEventListener('click', function () {
                logoutModalNotulis.classList.remove('hidden');
            });

            cancelLogoutNotulis?.addEventListener('click', function () {
                logoutModalNotulis.classList.add('hidden');
            });

            confirmLogoutNotulis?.addEventListener('click', function () {
                document.getElementById('logoutFormNotulis').submit();
            });
        })();
    </script>
</div>
