<?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use App\Events\UserAction;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Auth;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
            'lastname',
            'birthday',
            'phone',
            'nationality_id',
            'institution_id',
            'status'
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

        public function roles()
        {
            return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'rol_id');
        }

        public function institutions()
        {
            return $this->belongsTo(Institution::class, 'institution_id');
        }

        public function nationalities()
        {
            return $this->belongsTo(Nationality::class, 'nationality_id');
        }

        public function audits()
        {
            return $this->hasMany(Audit::class);
        }

        /* Detectar campos modificados al actualizar usuarios, detectar cuando se crean usuarios y cuando se eliminan:
            se toma el id del usuario que lo hizo, la acción, el detalle de la acción, el Id del usuario sobre el
            cual se aplicó dicha acción y la fecha y hora en que lo hizo */
        protected static function boot()
        {
            parent::boot();
            //actualización
            static::updating(function ($user) {
                $changed = $user->getDirty();
                $details = 'campos modificados: ' . implode(', ', array_keys($changed));
                event(new UserAction(Auth::user(), 'update', $details, $user->id));
            });
        }
    }
