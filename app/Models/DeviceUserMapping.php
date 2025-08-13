<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceUserMapping extends Model
{
    protected $table = 'device_user_mapping';

    protected $fillable = [
        'device_id',
        'user_name',
        // tambahkan kolom lain jika ada
    ];
}