<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enregistre extends Model
{
    use HasFactory;
    protected $table = "appartient";
    protected $primaryKey = "idannonce";
    public $timestamps = false;
}
