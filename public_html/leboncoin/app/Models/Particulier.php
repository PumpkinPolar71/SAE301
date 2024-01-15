<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulier extends Model
{
    use HasFactory;
    protected $table = "particulier";
    protected $primaryKey = "idparticulier";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class); // Relation inverse vers User
    }
    public function users()
    {
        return $this->belongsTo(Users::class, 'idcompte');
    }
}
