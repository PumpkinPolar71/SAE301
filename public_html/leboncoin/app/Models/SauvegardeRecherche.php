<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SauvegardeRecherche extends Model
{
    protected $table = 'SAUEGARDERECHERCHE';
    protected $primaryKey = 'IDSAUVEGARDE';
    public $timestamps = false;

    protected $fillable = [
        'IDPARTICULIER',
        'IDCOMPTE',
        'IDENTREPRISE',
        'NOMSAUVEGARDE',
        'NOMRECHERCHE',
        'PRIXMIN',
        'PRIXMAX',
        'LIBNBCHAMBRE',
        'NOMEQUITEMENT',
        'NOMEXTERIEUR',
        'NOMSERVICEETACCESS',
    ];

    // Définir les relations ici si nécessaire
    // Par exemple, une relation avec le modèle User
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'IDCOMPTE');
    }
}