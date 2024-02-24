<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Audit extends Model
    {
        use HasFactory;

        protected $table = 'audits';

        protected $fillable = [
            'user_id',
            'action',
            'details',
            'modified_user_id'
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
