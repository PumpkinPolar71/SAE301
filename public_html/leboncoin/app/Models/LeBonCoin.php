<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class LeBonCoin extends Model
{
    use HasFactory;
    protected $table = "annonce";
    protected $primaryKey = "idannonce";
    public $timestamps = false;

    protected $fillable = [
        'idconditionh',
        'idville',
        'idcompte',
        'codeetatvalide',
        'codeetattelverif',
        'identreprise',
        'idcritere',
        'idtype',
        'description',
        'dateannonce',
        'titreannonce',
        'resolu',
    ];


    public function annonce()
    {
        return $this->belongsTo('App\Models\LeBonCoin', 'idannonce');
    }
    public function annonceS()
    {
        return $this->hasOne(Annonce::class, 'idannonce');
    }
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
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'idannonce');
    }
}

