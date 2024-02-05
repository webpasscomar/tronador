<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_rol extends Model
{
    use HasFactory;

    protected $table = 'users_roles';

    protected $fillable = [
        'id',
        'user_id',
        'rol_id',
    ];

}
