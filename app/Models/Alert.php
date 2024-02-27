<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    protected $table = 'alerts';
    protected $fillable = ['titulo','title', 'descripcion','description', 'date', 'institution_id', 'status'];
    
    public function institutions()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}