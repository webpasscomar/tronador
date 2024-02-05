<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
    protected $fillable = ['nombre', 'descripcion', 'color', 'frecuencia', 'status'];

    // Relación con el modelo Organismo
    public function organismo()
    {
        return $this->belongsTo(Organismo::class);
    }

    // Relación con el modelo Capa
    public function capas()
    {
        return $this->hasMany(Capa::class);
    }
}
