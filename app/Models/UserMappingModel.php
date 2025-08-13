<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMappingModel extends Model
{
    //
    protected $table = 'device_user_mapping';

    protected $fillable = [
        'device_id',
        'user_name',
    ];

    public $timestamps = false; // Jika tabel tidak memiliki kolom created_at dan updated_at

    public function device(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class, 'device_id', 'device_id'); // Foreign key dan owner key
    }

}
