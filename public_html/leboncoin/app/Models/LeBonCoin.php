<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeBonCoin extends Model
{
    use HasFactory;
    protected $table = "annonce";
    protected $primaryKey = "idannonce";
    public $timestamps = false;
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function criteres()
    {
        return $this->hasMany(Critere::class, 'idcritere');
    }
    
    
}

