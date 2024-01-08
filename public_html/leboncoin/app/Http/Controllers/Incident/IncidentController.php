<?php

namespace App\Http\Controllers\Incident;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Incident;                        //IncidentController
use App\Models\Reservation;
use App\Models\Annonce;                         //AnnonceController                   
use App\Models\TypeHebergement;                 //AnnonceController
use App\Models\ConditionHebergement;            //AnnonceController
use App\Models\Photo;                           //AnnonceController
use App\Models\Critere;                         //AnnonceController
use App\Models\Appartient;                      //AnnonceController

use Illuminate\Support\Facades\Auth;


class IncidentController extends Controller
{
    //_____________________________________.Save_incident.______________________//
      public function incidentsave(Request $request) {
       
        $incident = new Incident();
        $incident->idincident = Incident::max('idincident') + 1;
        
        $incident->idannonce = (int)$request->input('idannonce');
        $incident->idcompte = (int)$request->input('idcompte');
        
        $incident->remboursement = false;
        $incident->procedurejuridique = false;
        $incident->resolu = false;
        $incident->commentaire = $request->input("commentaire");
        
        $incident->save();
        // Mettre à jour le prochain ID pour le prochain incident

        
        return redirect('/compte')->withInput()->with("incident", 'signalement créé');
      }
    //

    //_____________________________________.Incident_?.______________________//
      public function indexIncident()
      {
        $annonces = Annonce::all();
        $incidents = Incident::all();
        return view('incident/incidentclass', compact('incidents',"annonces"));             #incidentFolder
      }
    //

    //_____________________________________.Classer_incident_sans_suite.______________________//
      public function classementSansSuite(Request $request, $id)
      {
          $incident = Incident::find($id);

          $statut = $request->input('statut', 'non-resolu');

          $incident->resolu = true;

          $incident->commentaire = ($statut == 'resolu') ? 'Problème résolu' : 'Problème non résolu';

          $incident->save();

          return redirect('/incident');
      }
    //

    //_____________________________________.Afficher_incident_comme_résolu.______________________//
      public function resolution($id)
      {
          Incident::where('idincident', $id)->update(['resolu' => true]);
          return redirect('/incident');
      }
    //

    //_____________________________________.Voir_mes_incidents.______________________//
      public function mesIncidents()
      {
        $annonces = Annonce::all();
        $user = Auth::user();

        // Récupérer les incidents associés à l'utilisateur via la relation dans le modèle User
        $incidents = $user->incidents;
        $annonceDeposee = $user->annoncesDeposees;
      
        // dd($incidents);

        return view('incident/mes_incidents', compact('incidents','annonces','annonceDeposee'));           #incidentFolder
      }
    //

    //_____________________________________.Modifier_statut_incident.______________________//
      public function reconnaissanceJustifie(Request $request, $id)
      {
          $incident = Incident::find($id);
          $statut = $request->input('statut', 'non-resolu');
          $incident->resolu = true;
          $incident->save();
          return redirect('/mes-incidents');
      }
    //
}
