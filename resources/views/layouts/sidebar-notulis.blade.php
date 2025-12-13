<div class="w-full bg-sidebar-gradient p-5 shadow overflow-y-auto h-full rounded-r-2xl">

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
                      d="M6.75 3v2.25m10.5-2.25V5.25M3.375 9h17.25M4.5 6.75h15a2.25 2.25 0 012.25 2.25v9.75A2.25 2.25 0 0119.5 21H4.5A2.25 2.25 0 012.25 18.75V9a2.25 2.25 0 012.25-2.25Z" />
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
                      d="M6.75 3.75A2.25 2.25 0 019 1.5h6a2.25 2.25 0 012.25 2.25v16.5L12 17.25 6.75 21V3.75z" />
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
                      d="M3.375 7.5h17.25c.62 0 1.125-.5 1.125-1.125v-1.5
                      c0-.62-.505-1.125-1.125-1.125H3.375
                      c-.62 0-1.125.505-1.125 1.125v1.5
                      c0 .62.505 1.125 1.125 1.125z" />
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
                      d="M12 8.25h.008v.008H12V8.25zm0 3v6m9-3a9 9 0 11-18 0
                      9 9 0 0118 0z" />
            </svg>
            Tentang Kami
        </a>

    </nav>

    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST" class="mt-8">
        @csrf
        <button type="submit"
                class="flex items-center gap-2 text-red-600 font-bold hover:text-red-700">
            Keluar
        </button>
    </form>
</div>
