<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    protected $table = 'trails';
    protected $fillable = ['name', 'image', 'difficulty', 'kms', 'condition', 'duration', 'period', 'summary', 'geom', 'order','status'];
    
    // Relación con el modelo References
    public function references(){
        return $this->belongsToMany(Reference::class,'trail_id');
    }
    
}
