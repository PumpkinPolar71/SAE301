<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeBonCoin extends Model
{
    use HasFactory;
    protected $table = "annonce";
    protected $primaryKey = "idannonce";
    public $timestamps = false;

    protected $fillable = [
        'IDCONDITIONH',
        'IDVILLE',
        'IDCOMPTE',
        'CODEETATVALIDE',
        'CODEETATTELVERIF',
        'IDENTREPRISE',
        'IDCRITERE',
        'IDTYPE',
        'description',
        'DATEANNONCE',
        'titre',
        'resolu',
    ];



    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function criteres()
    {
        return $this->hasMany(Critere::class, 'idcritere');
    }
    public function avis()
    {
        return $this->hasMany(Avis::class, 'idannonce', 'idannonce');
    }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'recueille', 'idannonce', 'idequipement');
    }
    public function conditionHebergement()
    {
        return $this->belongsTo(ConditionHebergement::class, 'idconditionh');
    }
    
}

