<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonce';
    protected $primaryKey = 'idannonce';
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
        'titreannonce',
        'resolu',
    ];
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'idcompte');
    }
    public function appartient()
    {
        return $this->hasOne(Appartient::class, 'idannonce', 'idannonce');
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'idannonce', 'idannonce');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'idannonce');
    }
    public function annonce()
    {
        return $this->belongsTo('App\Models\Annonce', 'idannonce');
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
}
