<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'E-Notulen - Sistem Rapat')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-brand-green { background-color: #2f6b44; }
        .text-brand-green { color: #2f6b44; }
        .border-brand-green { border-color: #2f6b44; }
        .text-muted { color: #9aa39a; }

        .bg-sidebar-gradient {
            background: linear-gradient(180deg, #f7cfd0, #eebcc0);
        }
        .bg-header-gradient {
            background: linear-gradient(180deg, #eaa4a8, #f2c9cb);
        }
        .bg-pink-custom { background-color: #f7cfd0; }
        .hover-pink-custom-hover:hover { background-color: #eebcc0; }

        /* KUNCI ROOT */
        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            display: flex;
            flex-direction: row;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar-fixed {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 224px;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
        }

        /* MAIN WRAPPER */
        .main-content-wrapper {
            margin-left: 224px;
            flex: 1;
            height: 100vh;
            overflow: hidden; /* ⬅️ penting */
        }

        @media (max-width: 768px) {
            .sidebar-fixed {
                position: relative;
                width: 100%;
                height: auto;
            }
            .main-content-wrapper {
                margin-left: 0;
                height: 100vh;
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-brand-green antialiased">

{{-- ==========================
        SIDEBAR
   ========================== --}}
<div class="sidebar-fixed">
    @php
        $role = auth()->user()->role ?? null;
    @endphp

    @if($role === 'admin')
        @include('layouts.sidebar-tailwind')
    @elseif($role === 'notulis')
        @include('layouts.sidebar-notulis')
    @elseif($role === 'pegawai')
        @include('layouts.sidebar-pegawai')
    @elseif($role === 'pimpinan')
        @include('layouts.sidebar-pimpinan')
    @else
        <div class="p-4 text-red-600 font-bold">
            Sidebar tidak ditemukan.
        </div>
    @endif
</div>

{{-- ==========================
        MAIN CONTENT
   ========================== --}}
<div class="main-content-wrapper">
    <main
        class="p-4 md:p-7
        {{ request()->is('about') ? 'overflow-hidden' : 'overflow-y-auto' }}"
        style="height: 100vh;"
    >
        @yield('content')
    </main>
</div>

<script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@stack('scripts')

</body>
</html>
