<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    // ... Autres détails de votre modèle ...

    public function annonce()
    {
        return $this->belongsTo(LeBonCoin::class, 'idannonce');
    }
}
