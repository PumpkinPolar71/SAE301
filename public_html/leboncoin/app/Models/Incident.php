<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incidents';
    protected $primaryKey = 'idincident';

    protected $fillable = [
        'idannonce',
        'remboursement',
        'commentaire',
        'procedurejuridique',
        'resolu',
        // ... autres champs
    ];

    // Si tu veux définir les relations avec d'autres modèles, tu peux le faire ici
    // Par exemple :
    // public function annonce()
    // {
    //     return $this->belongsTo('App\Models\LeBonCoin', 'idannonce');
    // }
}
