<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersModel extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'group', 'name', 'phone', 'email', 'username', 'photo', 'password',
        'url', 'msg', 'status', 'sponsor_user_id', 'bank_id', 
        'bank_account_name', 'bank_account_address', 'created_by', 
        'updated_by', 'deleted_by'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
