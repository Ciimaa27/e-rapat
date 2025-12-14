<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Notulen</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* GRADIENT PINK */
        .pink-gradient {
    background: linear-gradient(180deg, #ffdddd 0%, #ffb9c2 45%, #ff9eae 100%);
}


        /* green */
        .text-brand-green { color: #31694E; }
        .bg-brand-green { background-color: #31694E; }
        .bg-brand-green:hover { background-color: #31694E; }
        .border-brand-green { border-color: #31694E; }
    </style>
</head>

<body class="min-h-screen flex">

    <!-- LEFT SECTION -->
    <div class="hidden md:flex w-1/2 pink-gradient flex-col justify-center px-10 lg:px-20 text-right items-end">
        <div class="max-w-md">
            <h1 class="text-3xl md:text-4xl font-bold text-brand-green mb-3">
                E-Notulen Cerdas
            </h1>

            <p class="text-sm md:text-base font-medium text-brand-green leading-relaxed">
                E-Notulen: Dengan Kecerdasan buatan, sekarang hanya perlu
                Rekam, Transkrip, Selesaikan. Efisiensi Rapat Tanpa Batas.
            </p>
        </div>
    </div>

    <!-- RIGHT SECTION -->
    <div class="flex w-full md:w-1/2 items-center justify-center p-6 bg-[#FFF9F9]">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

            <!-- LOGO -->
            <div class="text-center mb-6">
               <img src="{{ asset('foto/logo.png') }}" class="w-24 md:w-32 mx-auto mb-4" alt="logo">
            </div>

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <p class="text-red-600 text-center text-sm mb-3">{{ $errors->first() }}</p>
            @endif

            <!-- FORM -->
            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- EMAIL -->
                <label class="text-gray-700 text-sm font-medium">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 mb-4 px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-green text-sm"
                    placeholder="Masukkan email"
                    required
                >

               <!-- PASSWORD -->
<label class="text-gray-700 text-sm font-medium">Kata sandi</label>

<div class="mt-1 mb-6 w-full border border-gray-300 rounded-lg flex items-center px-3 focus-within:border-brand-green">
    
    <!-- Input -->
    <input
        type="password"
        id="password"
        name="password"
        class="w-full py-3 focus:outline-none text-sm"
        placeholder="********"
        required
    >

    <!-- BUTTON ICON -->
    <button type="button" id="togglePassword" class="ml-2 text-gray-400 hover:text-gray-600">

        <!-- Eye -->
        <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            <circle cx="12" cy="12" r="3" />
        </svg>

        <!-- Eye Off -->
        <svg id="iconEyeOff" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                  d="M3 3l18 18M10.477 10.489A3 3 0 0115 12m-3 3a2.99 2.99 0 01-1.511-.415M9.88 9.88A3 3 0 0114.12 14.12M6.228 6.228A9.96 9.96 0 003 12c1.274 4.057 5.065 7 9.542 7a9.96 9.96 0 004.772-1.272M9.88 9.88L6.228 6.228M14.12 14.12L17.772 17.772" />
        </svg>

    </button>
</div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full py-3 bg-brand-green text-white font-semibold rounded-lg shadow-sm hover:shadow transition">
                    Masuk
                </button>
            </form>

        </div>
    </div>

    <script>
        // Toggle show/hide password
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const iconEye = document.getElementById('iconEye');
        const iconEyeOff = document.getElementById('iconEyeOff');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            iconEye.classList.toggle('hidden');
            iconEyeOff.classList.toggle('hidden');
        });
    </script>

</body>
</html>
