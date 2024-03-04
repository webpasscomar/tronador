<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    protected $table = 'trails';
    protected $fillable =
    [
        'nombre',
        'name',
        'image',
        'dificultad',
        'difficulty',
        'kms',
        'elevation',
        'duracion',
        'duration',
        'periodo',
        'period',
        'resumen',
        'summary',
        'geom',
        'order',
        'status'
    ];
}
