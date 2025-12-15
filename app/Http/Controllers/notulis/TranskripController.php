<?php

namespace App\Http\Controllers\Notulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Notulen;

class TranskripController extends Controller
{
    // ====================================================
    // TAMPILKAN HALAMAN FORM TRANSKRIPSI
    // ====================================================
    public function create(Request $request)
    {
        $notulen = null;

        if ($request->filled('notulen_id')) {
            $notulen = Notulen::find($request->notulen_id);
        }

        return view('pages.notulis.notulen.transkip', [
            'notulen'      => $notulen,
            'originalText' => null,
            'generated'    => null,
        ]);
    }

    // ====================================================
    // GENERATE AI (GROQ – GRATIS)
    // ====================================================
    public function generate(Request $request)
    {
        $request->validate([
            'text'       => 'required|string',
            'notulen_id' => 'nullable|exists:notulens,id',
        ]);

        $originalText = $request->text;
        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return back()->with([
                'generated' => 'GROQ_API_KEY belum diset di file .env'
            ]);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
                'Content-Type'  => "application/json"
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 
"Tugas kamu adalah MERAPIKAN teks hasil transkripsi.
- Teks boleh sangat pendek, tetap diproses.
- Jangan menolak, jangan bilang 'tidak ada teks'.
- Tambahkan tanda baca, perbaiki typo, buat kalimat lebih rapi.
- Jangan mengubah makna."
                    ],
                    [
                        'role' => 'user',
                        'content' => $originalText
                    ]
                ],
                'temperature' => 0.2
            ]);

            if ($response->failed()) {
                return view('pages.notulis.notulen.transkip', [
                    'notulen'      => $request->filled('notulen_id') ? Notulen::find($request->notulen_id) : null,
                    'originalText' => $originalText,
                    'generated'    => 'Gagal memproses teks.'
                ]);
            }

            $generated = $response->json()['choices'][0]['message']['content']
                        ?? 'Gagal memproses teks.';

        } catch (\Throwable $e) {
            return view('pages.notulis.notulen.transkip', [
                'notulen'      => $request->filled('notulen_id') ? Notulen::find($request->notulen_id) : null,
                'originalText' => $originalText,
                'generated'    => 'Terjadi error: ' . $e->getMessage(),
            ]);
        }

        return view('pages.notulis.notulen.transkip', [
            'notulen'      => $request->filled('notulen_id') ? Notulen::find($request->notulen_id) : null,
            'originalText' => $originalText,
            'generated'    => $generated,
        ]);
    }
}
