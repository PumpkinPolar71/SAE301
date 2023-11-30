<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $table = "equipement";
    protected $primaryKey = "idequipement";
    public function annonces()
    {
        return $this->belongsToMany(LeBonCoin::class, 'recueille', 'idequipement', 'idannonce');
    }
}
