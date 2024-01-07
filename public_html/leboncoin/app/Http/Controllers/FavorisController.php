<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Models\Annonce;
use App\Models\Photo;
use App\Models\Ville;
use App\Models\Particulier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FavorisController extends Controller
{
    //_______________________________________________.Afficher_favoris.___________________________________________________//
        public function favoris($id) {
            $favoris = Favoris::where('idcompte', $id)->first();
            //$favoris = Favoris::find($id);
            $annonces = Annonce::all();
            $photos = Photo::all();
            $villes = Ville::all();
        
            return view('account/management/favoris', compact('favoris', "annonces", "photos","villes"));           #accountFolder #managementFolder
        }
    //

    //_______________________________________________.Ajouter_favoris.___________________________________________________//
        public function sauvefavoris($id) {
            $user = Auth::user();
            $favoris = Favoris::where('idcompte', $user->idcompte)->first();
            
            if (!$favoris) {
                $favoris = new Favoris();
                $favoris->idfavoris = Favoris::max('idfavoris') + 1;
                $favoris->idcompte = $user->idcompte;
                $favoris->libidannonce = $id;
            }
        
            $favoris->libidannonce = $favoris->libidannonce." ".$id;
        
            $particulier = Particulier::where('idcompte', $user->idcompte)->first();
            if ($particulier) {
                $favoris->idparticulier = $particulier->idparticulier;
            }
        
            // Sauvegarde seulement si $favoris est défini
            if ($favoris) {
                $favoris->save();
            }
        
        
            return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=');
        }
    //

    //_______________________________________________.Supprimer_favoris.___________________________________________________//
        public function supprfavoris($id) {
            $user = Auth::user();
            $favoris = Favoris::where('idcompte', $user->idcompte)->first();
            
            if ($favoris) {
                $tabann = explode(" ", $favoris->libidannonce);
                $updatedFavoris = [];
            
                foreach ($tabann as $value) {
                    if ($value != $id) {
                        $updatedFavoris[] = $value;
                    }
                }
            
                $favoris->libidannonce = implode(" ", $updatedFavoris);
                $favoris->save();
            } else {
                echo "Problème : Favoris introuvable.";
            }
        
            return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=');
        }
    //
}
