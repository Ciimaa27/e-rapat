<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notulen;
use App\Models\User;

class Rapat extends Model
{
    use HasFactory;

    protected $table = 'rapats'; // opsional, default-nya juga ini

    protected $fillable = [
        'judul_rapat',
        'tanggal',
        'jam',
        'ruangan',
        'notulis_id',
        'prioritas',
        'status',
        'dibuat_oleh',
    ];

    // Rapat punya satu notulen
    public function notulen()
    {
        return $this->hasOne(Notulen::class);
    }

    // Admin yang membuat rapat
    public function admin()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

     public function peserta()
    {
        return $this->belongsToMany(User::class, 'rapat_peserta')
                    ->withTimestamps();
    }

    public function notulis()
    {
        return $this->belongsTo(User::class, 'notulis_id');
    }
}
