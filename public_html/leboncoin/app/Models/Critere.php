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
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
    public function critere()
    {
        return $this->belongsTo(Critere::class, 'idcritere', 'libellecritere');
    }
}
