<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    protected $table = 'trails';
    protected $fillable = ['nombre', 'name', 'image', 'dificultad','difficulty', 'kms', 'condicion','condition', 'duracion','duration', 'periodo','period', 'resumen','summary', 'geom', 'order','status'];
    
    // Relación con el modelo References
    public function references(){
        return $this->belongsToMany(Reference::class,'trail_id');
    }
    
}
