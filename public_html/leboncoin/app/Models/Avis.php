<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    protected $table = "avis";
    protected $primaryKey = "idavis";
    public $timestamps = false;
    // public function compte()
    // {
    //     return $this->belongsTo(Compte::class, 'idcompte');
    // }

    // // Relation avec le particulier
    // public function particulier()
    // {
    //     return $this->belongsTo(Particulier::class, 'idparticulier');
    // }

    // // Relation avec l'annonce
    // public function annonce()
    // {
    //     return $this->belongsTo(Annonce::class, 'idannonce');
    // }
}
