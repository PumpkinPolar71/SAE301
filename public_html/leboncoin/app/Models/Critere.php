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
}
