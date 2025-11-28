<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $table = 'notulens';

    protected $fillable = [
        'rapat_id',
        'notulis_id',
        'judul_rapat',
        'tanggal',
        'jam',
        'topik',
        'status',
        'file',
    ];

    // Notulen milik satu rapat
    public function rapat()
    {
        return $this->belongsTo(Rapat::class, 'rapat_id');
    }

    // Notulen ditulis oleh satu user (notulis)
    public function notulis()
    {
        return $this->belongsTo(User::class, 'notulis_id');
    }
}
