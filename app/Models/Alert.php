<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    protected $table = 'alerts';
    protected $fillable = ['titulo','title', 'descripcion','description', 'date','finish', 'institution_id', 'status'];

}   
