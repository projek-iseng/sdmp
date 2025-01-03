<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelGaji extends Model
{
    use HasFactory;

    protected $table = 'gaji_m';

    protected $fillable = [
        'uuid',
        'is_active',
        'nominal',
        "kd_gaji",
        'created_by',
        'updated_by',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];
}
