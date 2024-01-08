<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incident';
    protected $primaryKey = 'idincident';
    public $timestamps = false; 
    

    protected $fillable = [
        'idannonce',
        'remboursement',
        'commentaire',
        'procedurejuridique',
        'resolu'];
        
    public function annonces()
    {
    return $this->belongsTo(Annonce::class, 'idannonce');
    }
    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'idannonce', 'idannonce');
    }
    public function compte()        //mes_incidents.blade.php
    {
        return $this->belongsTo(compte::class, 'idcompte');
    }
    public function reservations()      //mes_incidents.blade.php
    {
        return $this->hasMany(Reservation::class, 'idannonce');
    }
    

    // Si tu veux définir les relations avec d'autres modèles, tu peux le faire ici
    // Par exemple :
    // public function annonce()
    // {
    //     return $this->belongsTo('App\Models\LeBonCoin', 'idannonce');
    // }
}
