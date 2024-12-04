<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttemptsModel extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'attempts';
    protected $primaryKey = 'id';

    protected $fillable = [
        "user_id", "action", "is_success", "reason", "ip_address", "user_agent", "created_by", "updated_by", "deleted_by"
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
