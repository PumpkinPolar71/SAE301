<?php

namespace App\Http\Controllers\Autres;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\TypeHebergement;
use App\Models\Ville;
use App\Models\LeBonCoin;
use App\Models\Photo;
use App\Models\Reservation;
use App\Models\Favoris;
use App\Models\Compte;
use carbon\carbon;

class FiltreController extends Controller
{
        
        
        
    // public function adresse($q){
    //     $r = file_get_contents("https://api-adresse.data.gouv.fr/search/?type=json&q=$q");
    //     return response($r, 200)
    //     ->header('Content-Type', 'application/json');
    // }
}
