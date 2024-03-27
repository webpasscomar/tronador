<?php

    namespace App\Models;


    use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;

    class Institution extends Model
    {
        protected $table = 'institutions';
        protected $fillable = ['name', 'initial', 'status'];

        public function users()
        {
            return $this->hasMany(User::class, 'institution_id');
        }

        public function alers()
        {
            return $this->hasMany(Alert::class, 'institution_id');
        }

        public function references()
        {
            return $this->hasMany(Reference::class, 'institution_id');
        }
    }
