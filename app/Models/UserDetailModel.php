<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetailModel extends Model
{
    //
    protected $table = 'user_detail';

    protected $fillable = [
        'user_name',
        'address',
        'email',
        'phone',
        'company',
        'description',
    ];
    public $timestamps = false;

    // Tetapkan primary key ke kolom user_name
    protected $primaryKey = 'user_name';

    // Jika primary key bukan auto-increment
    public $incrementing = false;

    // Jika primary key adalah string
    protected $keyType = 'string';
}
