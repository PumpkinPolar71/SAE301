<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recherche;
use Illuminate\Support\Facades\Auth;
use App\Models\SauvegardeRecherche;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        //$searchTermLower = strtolower($searchTerm);


        return view('search', ['searchTerm' => $searchTerm]);
    }
    public function sauvrecherche(Request $request) {
        $a = new SauvegardeRecherche();
        $a->idsauvegarde = SauvegardeRecherche::max('idsauvegarde')+1;
        $a->idcompte =  Auth::id();
        if (Auth::user()->idparticulier == "") {
            $a->identreprise = Auth::user()->identreprise;
        } else {
            $a->idparticulier = Auth::user()->idparticulier;
        }
        $a->nomsauvegarde = "sauvegarde".SauvegardeRecherche::max('idsauvegarde')+1;
        $a->nomrecherche = "recherche".SauvegardeRecherche::max('idsauvegarde')+1;
        $a->prixmin = NULL;
        $a->prixmax = NULL;
        $a->libnbchambre = NULL;
        $a->nomequitement = "";
        $a->nomexterieur = "";
        $a->nomserviceetaccess = "";
        $a->nomvilles = $request->input('villess');
        $a->nomtypehebergement = $request->input('type_hebergementss');
        $a->save();
        return redirect('/');
    }
    
  
}
