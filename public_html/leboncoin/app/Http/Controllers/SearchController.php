<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recherche;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        //$searchTermLower = strtolower($searchTerm);


        return view('search', ['searchTerm' => $searchTerm]);
    }
    
    public function mesRecherches()
{
    // Récupère l'utilisateur connecté
    $user = Auth::user();

    // Récupère les recherches sauvegardées associées à l'utilisateur connecté
    $recherches = $user->sauvegardesRecherches;

    return view('mes_recherches', compact('recherches'));
}

}
