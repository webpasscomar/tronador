<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['name', 'image', 'description', 'pdf', 'topic_id', 'trail_id', 'institution_id', 'status'];

    public function institutions()
    {
      return $this->belongsTo(Institution::class, 'institution_id');
    }
    public function topics()
    {
      return $this->belongsTo(Topic::class, 'topic_id');
    }
    public function trails()
    {
      return $this->belongsTo(Trail::class, 'trail_id');
    }

}
