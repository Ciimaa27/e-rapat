<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'E-Notulen - Sistem Rapat')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-brand-green { background-color: #2f6b44; }
        .text-brand-green { color: #2f6b44; }
        .border-brand-green { border-color: #2f6b44; }
        .bg-sidebar-gradient {
            background: linear-gradient(180deg, #f7cfd0, #eebcc0);
        }
        .bg-pink-custom { background-color: #f7cfd0; }
        .hover-pink-custom-hover:hover { background-color: #eebcc0; }

        /* badge & status masih boleh dipakai di halaman lain */
        .badge {
            display:inline-block;
            padding:4px 8px;
            border-radius:4px;
            font-size:12px;
            font-weight:600;
        }
        .pri-normal   { background:#e0e7ff; color:#4f46e5; }
        .pri-penting  { background:#fef3c7; color:#d97706; }
        .pri-darurat  { background:#fee2e2; color:#dc2626; }

        .stat-menunggu {
            display:inline-block;
            padding:4px 8px;
            border-radius:4px;
            background:#fef3c7;
            color:#d97706;
            font-size:12px;
            font-weight:600;
        }
        .stat-disetujui {
            display:inline-block;
            padding:4px 8px;
            border-radius:4px;
            background:#dcfce7;
            color:#16a34a;
            font-size:12px;
            font-weight:600;
        }
        .stat-ditolak {
            display:inline-block;
            padding:4px 8px;
            border-radius:4px;
            background:#fee2e2;
            color:#dc2626;
            font-size:12px;
            font-weight:600;
        }
    </style>
</head>
<body class="bg-gray-50 text-brand-green antialiased font-[Poppins]">

    {{-- Layout utama: sidebar + konten --}}
    <div class="min-h-screen flex flex-col md:flex-row">
        {{-- Sidebar --}}
        @include('layouts.sidebar-tailwind')

        {{-- Main Content --}}
        <main class="flex-1 min-h-screen overflow-y-auto p-4 md:p-7">
            @yield('content')
        </main>
    </div>

    {{-- JS tambahan kalau memang dipakai --}}
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
