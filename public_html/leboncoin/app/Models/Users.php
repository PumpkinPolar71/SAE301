<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'idcompte';
    public $timestamps = false;


    public function particulier()
    {
        return $this->belongsTo(Particulier::class, 'idcompte', 'idcompte');
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'idcompte', 'idcompte');
    }     

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'motdepasse',
        'lastlogin',
    ];
   
    public function getAuthPassword() {
        return $this->motdepasse;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'datenaissanceparticulier',
        'lastlogin',
    ];
    // Méthode pour récupérer la dernière connexion d'un utilisateur
    public function getLastloginAttribute()
    {
        Log::info('getLastLogin');
        // dd($this->attributes); // Ajoutez cette ligne pour déboguer
        // Log::info(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 5)); // Limitez à 5 niveaux de profondeur
        return $this->attributes['lastlogin'];
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'motdepasse',
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


    // Méthode pour récupérer le prénom
    public function getPrenomAttribute()
    {
        return $this->compte->prenom;
    }

    // Méthode pour récupérer le nom
    public function getNomAttribute()
    {
        return $this->compte->nom;
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            Log::info('User updated. Updating lastlogin date in historisation table.');
            $user->updateLastLoginDateInHistorisation();
        });
    }

    public function updateLastLoginDateInHistorisation()
    {
        Log::info('Updating lastlogin date in historisation table.');
        $this->historisation()->update(['DATELOGIN' => $this->lastlogin]);
    }
}
