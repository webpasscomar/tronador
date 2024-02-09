<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationalities';

    protected $fillable = [
       'name',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'nationality_id');
    }

}
