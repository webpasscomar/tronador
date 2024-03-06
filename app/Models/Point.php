<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Point extends Model
{
    protected $table = 'points';
    protected $fillable = [
        'nombre',
        'name',
        'image',
        'pdf',
        'lat',
        'lng',
        'descripcion',
        'description',
        'trail_id',
        'tipo_id',
        'institution_id',
        'status'
    ];

    public function institutions()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
    public function tipos()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }
    public function trails()
    {
        return $this->belongsTo(Trail::class, 'trail_id');
    }
}
