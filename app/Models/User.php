<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\DeviceModel; // pastikan ini se

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan nama tabel yang digunakan
    protected $table = 'user';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'user_group',
        'status'
    ];

    // Kolom yang tidak boleh diisi secara massal
    protected $guarded = ['id'];

    // Jika tidak menggunakan timestamp otomatis
    public $timestamps = false;

    // Kolom yang akan disembunyikan dalam serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Menentukan casting untuk beberapa atribut
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Override method untuk menggunakan user_name sebagai identifier untuk login
     */
    public function getAuthIdentifierName()
    {
        return 'user_name';
    }

    /**
     * Method untuk check apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->user_group === 'admin';
    }

    /**
     * Method untuk check apakah user aktif
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Scope untuk filter user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('user_group', $role);
    }

    /**
     * Accessor untuk mendapatkan nama yang sudah diformat
     */
    public function getDisplayNameAttribute()
    {
        return ucfirst($this->user_name);
    }

    public function devices()
{
    return $this->belongsToMany(
        DeviceModel::class,
        'device_user_mapping',  // nama tabel pivot
        'user_name',            // foreign key di tabel pivot untuk user
        'device_id',            // foreign key di tabel pivot untuk device
        'user_name',            // local key di tabel users
        'device_id'             // local key di tabel devices
    );
}
}
