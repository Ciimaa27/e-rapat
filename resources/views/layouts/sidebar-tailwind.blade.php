<aside class="bg-sidebar-gradient p-5 shadow h-full overflow-y-auto">
    {{-- LOGO / HEADER KECIL --}}
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
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                   {{ request()->routeIs('dashboard') ? 'bg-white/40' : 'hover:bg-white/50' }}"
        >
            <svg class="w-5 h-5 text-brand-green" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zM13 21h8V11h-8v10zm0-18v6h8V3h-8z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- DATA RAPAT --}}
        <a
            href="{{ route('residents.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                   {{ request()->routeIs('residents.*') ? 'bg-white/40' : 'hover:bg-white/30' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Z" />
            </svg>
            <span>Data Rapat</span>
        </a>

        {{-- NOTULEN RAPAT --}}
        <a
            href="{{ route('notulen.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                {{ request()->routeIs('notulen.*') ? 'bg-white/40' : 'hover:bg-white/30' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span>Notulen Rapat</span>
        </a>

        {{-- DATA PENGGUNA --}}
        <a
            href="{{ route('users.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                {{ request()->routeIs('users.*') ? 'bg-white/40' : 'hover:bg-white/30' }}"
        >
            <svg class="w-5 h-5 text-brand-green" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 11c1.657 0 3-1.343 3-3S17.657 5 16 5s-3 1.343-3 3 1.343 3 3 3zM8 11c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zM8 13c-2.667 0-8 1.333-8 4v2h16v-2c0-2.667-5.333-4-8-4zM16 13c0-.29.02-.578.058-.861C16.776 14.01 20 15.228 20 17v2h4v-2c0-2.667-5.333-4-8-4z"/>
            </svg>
            <span>Data Pengguna</span>
        </a>

        {{-- ARSIP RAPAT --}}
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                   {{ request()->routeIs('arsip.*') ? 'bg-white/40' : 'hover:bg-white/30' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            <span>Arsip Rapat</span>
        </a>

        {{-- TENTANG KAMI --}}
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition
                   {{ request()->routeIs('about.*') ? 'bg-white/40' : 'hover:bg-white/30' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="w-5 h-5 text-brand-green">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <span>Tentang Kami</span>
        </a>
    </nav>

    {{-- LOGOUT --}}
    <a class="mt-8 inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-700 transition" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span>Keluar</span>
    </a>
</aside>
