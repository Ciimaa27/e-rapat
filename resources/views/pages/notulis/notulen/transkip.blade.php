@extends('layouts.app-tailwind')

@section('title', 'Transkrip Audio Notulen')

@section('content')
    <div class="p-5 mb-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-green">Transkrip Audio Notulen</h1>
                <p class="text-sm text-muted mt-1">
                    {{ now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                </p>

                @isset($notulen)
                    <div class="mt-3 text-xs text-gray-600"></div>
                @endisset
            </div>
            <div class="flex items-center gap-3"></div>
        </div>
    </div>

    <section class="bg-white rounded-lg p-5 shadow border space-y-4">
        <p class="text-sm text-gray-600">
            * Rekam suara, jika sudah selesai lakukan <span class="font-semibold">Generate dengan AI</span>.
        </p>

        <form action="{{ route('notulis.transkrip.generate') }}" method="POST" class="space-y-4">
            @csrf

            @isset($notulen)
                <input type="hidden" name="notulen_id" value="{{ $notulen->id }}">
            @endisset

            {{-- TOMBOL REKAM + GENERATE --}}
            <div class="flex flex-wrap gap-3">
                <button type="button"
                        id="recordBtn"
                        class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-semibold">
                    🎙 Rekam Suara
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold">
                    Generate AI
                </button>
            </div>

            {{-- TEXTAREA + COPY --}}
            <div class="relative">
                <textarea
                    name="text"
                    rows="8"
                    id="textArea"
                    class="w-full border rounded-md p-3 text-sm focus:outline-none focus:ring-1 focus:ring-brand-green"
                    placeholder="Teks hasil rekaman atau catatan manual di sini..."
                >{{ old('text', $originalText ?? '') }}</textarea>

                <button type="button"
                    id="copyBtn"
                    class="absolute top-2 right-2 px-3 py-1 bg-gray-700 text-white text-xs rounded-md hover:bg-gray-900 transition">
                    📋 Copy
                </button>
            </div>

            @error('text')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </form>

        @isset($generated)
            <div class="border-t pt-4 mt-2">
                <h2 class="font-bold text-brand-green mb-2">Hasil Generate AI</h2>
                <div class="relative border rounded-md p-3 bg-gray-50 text-sm whitespace-pre-line" id="generatedBox">

                    {{ $generated }}

                    <button type="button"
                        id="copyGenerated"
                        class="absolute top-2 right-2 px-2 py-1 bg-gray-700 text-white text-xs rounded-md hover:bg-gray-900 transition">
                        📋 Copy
                    </button>

                </div>
            </div>
        @endisset
    </section>

    {{-- ====================================== --}}
    {{-- TOMBOL KEMBALI DI POJOK KIRI BAWAH --}}
    {{-- ====================================== --}}
    <div class="mt-6 flex justify-start">
        <a href="{{ route('notulis.notulen.index') }}"
           class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md text-sm font-semibold hover:bg-gray-400 transition">
            ⬅ Kembali
        </a>
    </div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const recordBtn = document.getElementById('recordBtn');
    const textArea  = document.getElementById('textArea');
    const copyBtn   = document.getElementById('copyBtn');

    // COPY TEXTAREA
    if (copyBtn) {
        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(textArea.value);
            copyBtn.innerText = "✔ Copied!";
            setTimeout(() => copyBtn.innerText = "📋 Copy", 1200);
        });
    }

    // COPY GENERATED
    const copyGenerated = document.getElementById('copyGenerated');
    const generatedBox  = document.getElementById('generatedBox');

    if (copyGenerated) {
        copyGenerated.addEventListener('click', () => {
            navigator.clipboard.writeText(generatedBox.innerText.trim());
            copyGenerated.innerText = "✔ Copied!";
            setTimeout(() => copyGenerated.innerText = "📋 Copy", 1200);
        });
    }

    // SPEECH RECOGNITION
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (!SpeechRecognition) {
        alert("Browser kamu tidak mendukung Speech Recognition. Gunakan Google Chrome.");
        return;
    }

    const recognition = new SpeechRecognition();
    recognition.lang = "id-ID";
    recognition.langs = ["id-ID", "en-US"];
    recognition.continuous = true;
    recognition.interimResults = true;

    let isRecording = false;
    let finalTranscript = "";

    recordBtn.addEventListener('click', () => {
        if (!isRecording) {
            finalTranscript = "";
            recognition.start();
            isRecording = true;
            recordBtn.innerText = "⏹ Stop Rekaman";
            recordBtn.classList.remove("bg-red-600");
            recordBtn.classList.add("bg-gray-700");
        } else {
            recognition.stop();
            isRecording = false;
            recordBtn.innerText = "🎙 Rekam Suara";
            recordBtn.classList.remove("bg-gray-700");
            recordBtn.classList.add("bg-red-600");
        }
    });

    recognition.onresult = (event) => {
        let interimText = "";

        for (let i = 0; i < event.results.length; i++) {
            const transcript = event.results[i][0].transcript;

            if (event.results[i].isFinal) {
                finalTranscript += transcript + " ";
            } else {
                interimText = transcript;
            }
        }

        textArea.value = finalTranscript + interimText;
    };

    recognition.onerror = (event) => {
        alert("Error: " + event.error);
    };

});
</script>
@endpush
