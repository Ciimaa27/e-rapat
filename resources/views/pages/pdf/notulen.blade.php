<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notulen Rapat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1   { font-size: 18px; margin-bottom: 5px; }
        .meta { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .content { margin-top: 10px; white-space: pre-line; }
    </style>
</head>
<body>
    <h1>{{ $notulen->judul_rapat }}</h1>

    <div class="meta">
        <div><span class="label">Tanggal:</span> {{ \Carbon\Carbon::parse($notulen->tanggal)->format('d-m-Y') }}</div>
        <div><span class="label">Topik:</span> {{ $notulen->topik }}</div>
    </div>

    <div class="content">
        {!! nl2br(e($notulen->isi_notulen ?? '')) !!}
    </div>
</body>
</html>
