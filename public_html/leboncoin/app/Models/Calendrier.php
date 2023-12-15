<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;
    protected $table = 'calendrier'; // Nom de la table

    protected $primaryKey = 'idperiode'; // Clé primaire

    public $timestamps = false; // Si vous n'avez pas de timestamps (created_at, updated_at)

    protected $fillable = [
        'nomperiode',
        // Ajoutez ici d'autres champs que vous avez dans votre table
    ];
}
