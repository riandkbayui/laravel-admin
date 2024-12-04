<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigsModel extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'configs';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        "group","value","description","created_by","updated_by","deleted_by"
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
