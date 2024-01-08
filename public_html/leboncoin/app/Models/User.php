<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Incident;
use App\Models\Annonce;
use App\Models\SauvegardeRecherche;

class User extends Authenticatable
{
    protected $table = "compte";
    public $timestamps = false;
    protected $primaryKey = "idcompte";
    use HasApiTokens, HasFactory, Notifiable;
    
    public function compte()
    {
        return $this->belongsTo(Compte::class, 'idcompte');
    }
    public function particulier()
    {
        return $this->belongsTo(Particulier::class, 'idcompte', 'idcompte');
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'idville', 'idville');
    }        
    public function incidents()
    {
        return $this->hasMany(Incident::class, 'idcompte');
    }       //mes_incidents.blade.php

    public function sauvegardesRecherches()
    {
        return $this->hasMany(SauvegardeRecherche::class, 'IDCOMPTE');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'motdepasse',
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
    ];

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


// Ajoutez une méthode pour récupérer le prénom
public function getPrenomAttribute()
{
    return $this->compte->prenom;
}

// Ajoutez une méthode pour récupérer le nom
public function getNomAttribute()
{
    return $this->compte->nom;
}

}

