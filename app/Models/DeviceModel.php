<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeviceModel extends Model
{
    protected $table = 'device';

    protected $fillable = [
        'device_id',
        'device_name',
        'ip_address',
        'mac_address',
        'type',
        'description',
    ];

    public $timestamps = false;
    protected $primaryKey = 'device_id'; // Tetapkan primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string'; // Jika primary key adalah string

    public function transactionEnoses(): HasMany
    {
        return $this->hasMany(TransactionEnoseModel::class, 'device_id');
    }

    public function transactionEdge(): HasMany
    {
        return $this->hasMany(TransactionEdgeModel::class, 'device_id');
    }

    public function userMapping(): HasMany
    {
        return $this->hasMany(UserMappingModel::class, 'device_id');
    }
}
