<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
    protected $table = "carte";
    protected $primaryKey = "idcarte";
    public $timestamps = false;
}
