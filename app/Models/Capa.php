<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capa extends Model
{
    protected $table = 'capas';
    protected $fillable = ['titulo', 'resumen', 'indicador_id', 'presentacion', 'fechaDesde', 'fechaHasta', 'georeferencial', 'status'];

    // Relación con el modelo Indicador
    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }
}
