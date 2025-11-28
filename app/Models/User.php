<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ================================
    //  HELPER CEK ROLE USER
    // ================================

    public function isAdmin(): bool
    {
        return strtolower($this->role) === 'admin';
    }

    public function isNotulis(): bool
    {
        return strtolower($this->role) === 'notulis';
    }

    public function isPimpinan(): bool
    {
        return strtolower($this->role) === 'pimpinan';
    }

    public function isPegawai(): bool
    {
        return strtolower($this->role) === 'pegawai';
    }

    // ================================
    //  HITUNG USER PER ROLE (DIPAKAI DI DASHBOARD)
    // ================================

   public static function countByRole(string $role): int
    {
        return self::whereRaw('LOWER(role) = ?', [strtolower($role)])->count();
    }

    public static function countAdmin(): int
    {
        return self::countByRole('admin');
    }

    public static function countPegawai(): int
    {
        return self::countByRole('pegawai');
    }

    public static function countNotulis(): int
    {
        return self::countByRole('notulis');
    }

    public static function countPimpinan(): int
    {
        return self::countByRole('pimpinan');
    }
}
