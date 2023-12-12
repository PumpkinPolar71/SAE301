<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recherche extends Model
{
    protected $fillable = ['user_id', 'mot_cle', 'categorie'];
    
}