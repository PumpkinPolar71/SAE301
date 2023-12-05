<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    
    use HasFactory;
    protected $table = "reservation";
    protected $primaryKey = "idreservation";
    public $timestamps = false;
    protected $datedebut = ['datedebut'];
    protected $datefin = ['datefin'];
    

    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'idannonce');
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'idreservation');
    }
}
