<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiModel extends Model
{
    use HasFactory;

    protected $table = 'gaji_m';

    protected $fillable = [
        'uuid',
        'is_active',
        'nominal',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];
}
