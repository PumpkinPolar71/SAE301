<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;                        //IncidentController

use App\Models\LeBonCoin;                       //AnnonceController
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
        
        $incident->idannonce = $request->input('id');
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
        $annonces = LeBonCoin::all();
        $incidents = Incident::all();
        return view('incidentclass', compact('incidents',"annonces"));
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
          $annonces = LeBonCoin::all();
          $user = Auth::user();
          $incidents = $user->incidents;
          return view('mes_incidents', compact('incidents','annonces'));
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
