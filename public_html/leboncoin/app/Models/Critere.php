<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    protected $table = "critere";
    protected $primaryKey = "idcritere";
    public $timestamps = false;

    public function annonces()
    {
        return $this->hasMany(LeBonCoin::class, 'idcritere');
    }
    
    /*public static function getLabelsForSpecificCriteres()
{
    return [
        1 => 'Nb étoiles',
        2 => 'Capacité',
        3 => 'Nb chambres',
        // Ajoutez d'autres IDs de critères avec leurs libellés associés
    ];
}*/
   
}




