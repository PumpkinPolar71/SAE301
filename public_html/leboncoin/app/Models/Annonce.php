<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonce'; // Si le nom de la table est différent de la convention

    protected $primaryKey = 'idannonce'; // Si la clé primaire est différente de 'id'

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
    

    // Exemple de relation avec un utilisateur
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
    // Exemple d'autres relations ou méthodes en fonction de tes besoins
}
