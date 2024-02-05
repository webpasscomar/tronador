<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    protected $table = 'organismos';
    protected $fillable = ['nombre', 'sigla', 'status'];

    // Relación con el modelo Indicador
    public function indicadores()
    {
        return $this->hasMany(Indicador::class);
    }
}
