<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionHebergement extends Model
{
    use HasFactory;
    protected $table = "condition_hebergement";
    protected $primaryKey = "idconditionh";
    public $timestamps = false;
    public function annonces()
    {
        return $this->hasMany(LeBonCoin::class, 'idconditionh');
    }

}
