<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;

use App\Models\Reservation;                     //ReservationController
use App\Models\Ville;                           
use App\Models\Annonce;                           
use App\Models\Photo;                           

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    //_____________________________________.Récupérer_infos_réservation_grace_a_un_id.______________________//
        public function oneres($id) {
            $id = $id;
            $villes = Ville::all();
            $annonces = Annonce::all();
            return view("reservation/reservationlist", compact('id', "villes", "annonces"));            #reservationFolder
        }
    //

    //_____________________________________.Récupérer_réservation_lié_à_une_annonce.______________________//

        public function reservation($id) {
            $reservation = Reservation::find($id);
            $annonce = Annonce::find($reservation->idannonce); // Récupérer l'annonce associée à la réservation
        
            $photos = Photo::join('annonce', 'photo.idannonce', '=', 'annonce.idannonce')
                            ->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
                            ->where('idreservation', $id)
                            ->get();
            return view("reservation/reservation", compact('reservation', 'annonce', 'photos'));            #reservationFolder
        }
    //
    
    //_____________________________________.Récupérer_données_annonce_pour_créer_une_nouvelle_reservation.______________________//
        public function newres(){
            $annonces = Annonce::all();
            $user = auth()->user();
            return view('reservation/newreservation', ['annonces' => $annonces]);                   #reservationFolder
            return view('reservation/newreservation');                                              #reservationFolder
        }
    //

    //_____________________________________.Ajouter_une_nouvelle_réservation.______________________//
      public function ajouterReservation(Request $request,$id)
      {
        if (
          $request->input("nbadulte") == ""  ||
          $request->input("nbenfant") == "" ||
          $request->input("nbbebe") == "" ||
          $request->input("nbanimaux") == "" ||
          $request->input("prenom") == "" ||
          $request->input("nom") == "" ||
          $request->input("tel") == "" ||
          $request->input("nbnuitee") == "" ||
          $request->input("datedebutr") == "" ||
          $request->input("datefinr") == "" 
          ) {return redirect('newreservation')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
        } else {

            // Création d'une nouvelle réservation
            $reservation = new Reservation();
            $reservation->idreservation = Reservation::max('idreservation')+1;
            $reservation->idannonce = $request->input('idannonce');
            $reservation->idcompte = Auth::id();
            $reservation->idparticulier = Auth::id(); // ID du particulier connecté
            $reservation->nbadulte = $request->input('nbadulte');
            $reservation->nbenfant = $request->input('nbenfant');
            $reservation->nbbebe = $request->input('nbbebe');
            $reservation->nbanimaux = $request->input('nbanimaux');
            $reservation->prenom = $request->input('prenom');
            $reservation->nom = $request->input('nom');
            $reservation->tel = $request->input('tel');
            $nbNuits = $request->input('nbnuitee');
            $reservation->nbnuitee = $nbNuits;
            $datedebut = $request->input('datedebutr');
            $datefin = $request->input('datefinr');
            $reservation->datedebutr = $datedebut;
            $reservation->datefinr = $datefin;
            $reservation->montantimmediatacompte = $request->has('montantimmediatacompte');
            $reservation->montantimmediat = $request->input('montantimmediat');
            $taxesSejour = $request->input('montantimmediat') * 0.1;
            $reservation->taxessejour = $taxesSejour;
            // Sauvegarde de la réservation
            $reservation->save();

            return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->with('success', 'Réservation effectuée avec succès !');
          }
        }
    //

    //_____________________________________.Afficher_le_formulaire_de_réservation.______________________//
        public function showreservationForm($idannonce) 
        {
            $annonce = Annonce::find($idannonce);
            $libelleDateDebut = $annonce->libelledatedebut;
            $libelleDateFin = $annonce->libelledatefin;
            $datedebut = $annonce->datedebut;
            $datefin = $annonce->datefin;
            $compte = auth()->user()->compte;
            $numeroTelephone = $compte->tel; 
            $user = auth()->user();
            $prenom = $user->particulier->prenomparticulier;
            $nom = $user->particulier->nomparticulier;
            $datesDisponibles = Annonce::where('idannonce', $idannonce)->pluck('datedebut', 'datefin');
            $reservation = Reservation::where('idannonce', $idannonce)->first();
            $montantimmediatacompte = $annonce->libprix;
        
            return view('reservation/newreservation', [                                                         #reservationFolder
                'idannonce' => $idannonce,
                'numeroTelephone' => $numeroTelephone,
                'user' => $user,
                'datesDisponibles' => $datesDisponibles,
                'prenom' => $prenom,
                'nom' => $nom,
                'montantimmediatacompte' => $montantimmediatacompte,
                'datedebut' => $datedebut,
                'datefin' => $datefin
            ]);

        }
    //

    //_____________________________________.Afficher_le_formulaire_de_payement.______________________//
        public function showPayementForm($idannonce)
        {
            $annonce = Annonce::find($idannonce);
        
            $compte = auth()->user()->compte;
        
            $user = auth()->user();
        
            return view('reservation/payement_reservation', ['idannonce' => $idannonce]);                                       #reservationFolder
        }
    //

    //_____________________________________.Régler_payement_réservation.______________________//
        public function payement(Request $request,$idannonce)
        {
          if (
                $request->input("nbadulte") == ""  ||
                $request->input("nbenfant") == "" ||
                $request->input("nbbebe") == "" ||
                $request->input("nbanimaux") == "" ||
                $request->input("prenom") == "" ||
                $request->input("nom") == "" ||
                $request->input("tel") == "" ||
                $request->input("nbnuitee") == "" ||
                $request->input("datedebutr") == "" ||
                $request->input("datefinr") == "" 
            ) 
                {
                    return redirect('newreservation')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
                } 
            else {
              $reservation = new Reservation();
            
              $reservation->idannonce = $request->input('idannonce');
            
              return view('reservation/payement_reservation');                                                                      #reservationFolder
            }
        }
    //
}
