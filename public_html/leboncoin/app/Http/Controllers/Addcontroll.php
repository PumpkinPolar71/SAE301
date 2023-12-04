<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Photo;
use App\Models\Critere;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LeBonCoinController extends Controller
{

    public function add() {
        return view("annonceuh-add");
    }

    }

    
