<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historisation extends Model
{
    use HasFactory;
    protected $table = 'historisation';
    protected $primaryKey = 'idhistorisation';
    public $timestamps = false; 

    protected $fillable = ['idcompte', 'datelogin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idcompte');
    }
}