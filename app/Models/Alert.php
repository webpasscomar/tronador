<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    protected $table = 'alerts';
    protected $fillable = ['title', 'summary', 'date', 'institution_id', 'owner', 'status'];


    public function institutions()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
