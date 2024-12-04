<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogsModel extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';
    protected $primaryKey = 'id';

    protected $fillable = [
        "thumbnail","slug","title","description","content","category","tags","publish_at","status","created_by","updated_by","deleted_by"
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
