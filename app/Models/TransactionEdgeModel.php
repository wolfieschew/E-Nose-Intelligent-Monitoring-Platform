<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionEdgeModel extends Model
{
    protected $table = 'transaction_object_detection';

    public function device(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class, 'device_id', 'device_id'); // Foreign key dan owner key
    }
}
