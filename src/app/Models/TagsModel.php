<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagsModel extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'tags';
    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "created_by", "updated_by", "deleted_by"
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
