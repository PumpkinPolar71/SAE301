<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $table = "entreprise";
    protected $primaryKey = "identreprise";
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'idcompte');
    }

}


