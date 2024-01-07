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
    //_____________________________________.Récupérer_infos_serviceimmobilier.______________________//
        public function serviceimmobilier() {
            $villes = Ville::all();
            $annonces = LeBonCoin::all();
            $photos = Photo::all();
            return view("service/service_immobilier/serviceimmobilier",compact('annonces', "photos", "villes"));            #serviceFolder #service_immobilierFolder
        }
    //

    //_____________________________________.Récupérer_infos_annonce_grace_a_une_valeur.______________________//
        public function oneann(Request $request) {
            if ($request->input("annval") == "") {
                return redirect('serviceimmobilier')->withInput()->with("error","La validation n'a pas fonctionné");
            } else {
                $annonces = LeBonCoin::all();
                $element = LeBonCoin::find($request->input("id"));
                if ($request->input("annval") == "oui") {
                    $element->codeetatvalide = true;
                    $element->save();
                } 
                elseif ($request->input("annval") == "non") {
                    // $annonces->foreign('idannonce')->references($request->input("id"))->on('annnonce')->onDelete('cascade');
                    $element->annonceS()->delete();
                } else {

                }
                 return redirect('serviceimmobilier')->withInput()->with("error","Validation effectuée");
            }
        }
    //

    //_____________________________________.Recevoir_les_(nv)_types_d'hebergement_ou_les_(nv)_equipements.______________________//
        public function createheb() {
            $typehebergements = TypeHebergement::all();
            $equipements = Equipement::all();
            return view("service/service_annonce/createheb",compact('typehebergements', "equipements"));            #serviceFolder #service_annonceFolder
        }
    //

    //_____________________________________.Ajouter_un_nv_type_hebergement.______________________//
        public function ajoutheb(Request $request) {
        
            if ($request->input("nomhebergement") != "") {
                $h = new TypeHebergement();
                $h->idtype = TypeHebergement::max('idtype')+1;
                $h->type = $request->input("nomhebergement");
                $h->save();
            }
            $typehebergements = TypeHebergement::all();
            $equipements = Equipement::all();
            return view("service/service_annonce/createheb",compact('typehebergements', "equipements"));                #serviceFolder #service_annonceFolder
        }
    //

    //_____________________________________.Ajouter_un_nv_equipement.______________________//
        public function ajoutequ(Request $request) {
            if ($request->input("nomequipement") != "") {
                $h = new Equipement();
                $h->idequipement = Equipement::max('idequipement')+1;
                $h->nomequipement = $request->input("nomequipement");
                $h->save();
            }
            $typehebergements = TypeHebergement::all();
            $equipements = Equipement::all();
            return view("service/service_annonce/createheb",compact('typehebergements', "equipements"));                #serviceFolder #service_annonceFolder
        }
    //

    //_____________________________________.Inscription_en_attente.______________________//
        public function afficherInscriptionAttente()
        {
            //Récupérer toutes les réservations
            $reservations = Reservation::all();
            $particuliers = Particulier::all();
            $annonces = Annonce::all();
            $entreprises = Entreprise::all();
            $comptes = Compte::all();
            $reservationsParAnnonce = $reservations->groupBy('idannonce');
        
            return view('service/service_inscription/inscription-attente', compact('reservations' , 'particuliers' , 'annonces', 'reservationsParAnnonce', 'entreprises', 'comptes')) ;         #serviceFolder #service_inscriptionFolder
        }
    //
}
