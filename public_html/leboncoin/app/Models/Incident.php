<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incident';
    protected $primaryKey = 'idincident';
    public $timestamps = false; // Désactiver la gestion automatique des timestamps
    

    protected $fillable = [
        'idannonce',
        'remboursement',
        'commentaire',
        'procedurejuridique',
        'resolu'];
        // ... autres champs
        public function annonces()
    {
        return $this->belongsTo(Annonce::class, 'idannonce');
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'idreservation');
    }
    

    // Si tu veux définir les relations avec d'autres modèles, tu peux le faire ici
    // Par exemple :
    // public function annonce()
    // {
    //     return $this->belongsTo('App\Models\LeBonCoin', 'idannonce');
    // }
}
