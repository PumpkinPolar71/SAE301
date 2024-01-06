<?php

namespace App\Http\Controllers;
use App\Models\Reservation;                     //ReservationController
use App\Models\Ville;                           
use App\Models\Annonce;                           

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    //_____________________________________.Récupérer_infos_réservation_grace_a_un_id.______________________//
        public function oneres($id) {
            $id = $id;
            $villes = Ville::all();
            $annonces = Annonce::all();//find($id)
            return view("reservationlist", compact('id', "villes", "annonces"));
        }
    //
    
    //_____________________________________.Récupérer_réservation_lié_à_une_annonce.______________________//

        public function reservation($id) {
            $reservation = Reservation::find($id);
            $annonce = LeBonCoin::find($reservation->idannonce); // Récupérer l'annonce associée à la réservation
        
            $photos = Photo::join('annonce', 'photo.idannonce', '=', 'annonce.idannonce')
                            ->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
                            ->where('idreservation', $id)
                            ->get();
            return view("reservation", compact('reservation', 'annonce', 'photos'));
        }
    //
}
