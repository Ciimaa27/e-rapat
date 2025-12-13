<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapat_id',
        'judul_rapat',
        'tanggal',
        'jam',
        'topik',
        'status',
        'notulis_id',
        'file',
    ];

    // Relasi ke rapat
    public function rapat()
    {
        return $this->belongsTo(Rapat::class);
    }

    // Relasi ke user (notulis)
    public function notulis()
    {
        return $this->belongsTo(User::class, 'notulis_id');
    }
}
