<?php

namespace App\Models\masterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users_M';
    //
    protected $guarded = ['id'];
}
