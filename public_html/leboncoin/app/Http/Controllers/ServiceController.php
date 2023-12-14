<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Photo;
use App\Models\LeBonCoin;
use App\Models\Ville;
use App\Models\TypeHebergement;
use App\Models\Equipement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function serviceimmobilier() {
        $villes = Ville::all();
        $annonces = LeBonCoin::all();
        $photos = Photo::all();
        return view("serviceimmobilier",compact('annonces', "photos", "villes"));
    }
    
    public function one(Request $request) {
        if ($request->input("annval") == "") {
            return redirect('serviceimmobilier')->withInput()->with("error","La validation n'a pas fonctionné");
        } else {
            if ($request->input("annval") == "oui") {

            } 
            elseif ($request->input("annval") == "non") {

            } else {

            }
             return redirect('serviceimmobilier')->withInput()->with("error","Validation effectuée");
        }
    }
    public function createheb() {
        $typehebergements = TypeHebergement::all();
        $equipements = Equipement::all();
        return view("createheb",compact('typehebergements', "equipements"));
    }
    public function ajoutheb(Request $request) {
        $typehebergements = TypeHebergement::all();
        $equipements = Equipement::all();
        if ($request->input("nomequipement") == "") {
            return view("createheb",compact('typehebergements', "equipements"))->with("error","Creation échoué");;
        } else {
            $h = new TypeHebergement();
            $h->idtype = TypeHebergement::max('idtype')+1;
            $h->type = $request->input("nomequipement");
            return view("createheb",compact('typehebergements', "equipements"));
        }
    }
}
