<?php
//Web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\Autres\SiteController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Autres\FiltreController;
use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Service\ServiceController;
// use App\Http\Controllers\GeocodeController;
use App\Http\Controllers\Account\CreateAccountController;
// use App\Http\Controllers\EncryptionController;
// use App\Http\Controllers\UploadController;
use App\Http\Controllers\Annonce\AnnonceController;
// use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\Account\FavorisController;
use App\Http\Controllers\Incident\IncidentController;
use App\Http\Controllers\Account\InfosBancairesController;
// use App\Http\Controllers\LocalisationController;
use App\Http\Controllers\Footer\AideController;
use App\Http\Controllers\Reservation\ReservationController;
use App\Http\Controllers\Search\RechercheController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Footer\DroitController;
use App\Http\Controllers\Discussion\DiscussionController;
use App\Http\Controllers\Autres\ImgGDController;
use App\Http\Controllers\BotManController;

use App\Models\User;

Route::get('/debug-lastlogin', function () {
    $user = User::find(1);
    \Log::info($user->lastlogin);
});

Route::get('/user/profile', [UserController::class, 'showUserProfile']);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//_______________________________________________.MIDDLEWARE_Incidents_RecherchesSauvegardées.___________________________________________________//
    //------------------------------------Global-------------------------------------//
        Route::middleware(['auth'])->group(function () {
            Route::get('/mes-incidents', [IncidentController::class, 'mesIncidents'])->name('mes-incidents');                                           //Incident
            Route::post('/reconnaissance-justifie/{id}', [IncidentController::class, 'reconnaissanceJustifie'])->name('reconnaissance-justifie');      //Incident
            Route::get('/mes-recherches', [RechercheController::class, 'mesRecherches'])->name('mes-recherches');                                       //Sauvegarde_Recherche
        });
//

//_______________________________________________.LEBONCOIN_CONTROLLER.___________________________________________________//
    //------------------------------------Redirection_connexion-------------------------------------//
        Route::get("/connect", [ LeBonCoinController::class, "connect"])->name('connect');
        Route::post("/connect", [ LeBonCoinController::class, "connect"])->name('connect');
    //------------------------------------Redirection_obligation_de_connexion-------------------------------------//
        Route::get('/redirection', [LeBonCoinController::class, 'redirection'])->name('redirection');
    //------------------------------------Redirection_simple-------------------------------------//
        Route::get('/', function () {
            return view('welcome');
            redirect('/annonces');
        });
    //------------------------------------Sert_à_?-------------------------------------//
        Route::post('/process-form', [LeBonCoinController::class, 'processForm'])->name('process-form');    // View appropriée inconnue 
//

//_______________________________________________.ANNONCE_CONTROLLER.___________________________________________________//
    
    //------------------------------------Afficher_les_annonces-------------------------------------//
        Route::get("/annonces",[LeBonCoinController::class, "index" ]); //sert a rien non ? a refaire css
    //------------------------------------Adresse_annonce?-------------------------------------//
        // Route::get('/adresse/{q}', [FiltreController::class, 'adresse']);

    //------------------------------------affiche_l'annonce-------------------------------------//
        Route::get("/annonce/{id}",[AnnonceController::class, "one" ]);
        Route::post("/annonce/{id}",[AnnonceController::class, "one" ]);
    //------------------------------------Créer_une_nouvelle_annonce-------------------------------------//
        Route::get("/createAnnonce",[ AnnonceController::class, "add" ]);
        Route::post("/ajouterAnnonce",[ AnnonceController::class, "ajouterAnnonce" ]);
    //------------------------------------Afficher_le_proprietaire_de_l'annonce-------------------------------------//
        Route::get("/proprio/{id}",[AnnonceController::class, "proprio" ]);
    //------------------------------------Afficher_les_infos_annonce_que_seul_le_service_peut_voir-------------------------------------//
        Route::post("/annonceserv/{id}",[AnnonceController::class, "one" ])->name('annonceserv');
    //--------------------------------------Vérifier_annonce_non-validée------------------------------//
        Route::get('/annonces-non-validees', [AnnonceController::class, 'annoncesNonValidees'])->name('annonces.non-validees');
    //--------------------------------------Vérifier_annonce_validée------------------------------//
        Route::post('/valider-annonce/{idannonce}', [AnnonceController::class, 'validerAnnonce'])->name('validerAnnonce');

//

//_______________________________________________.INCIDENT_CONTROLLER.___________________________________________________//
    //--------------------------------------Sauvegarder_un_incident------------------------------//
        Route::post('/reservation/incidentsave', [IncidentController::class, 'incidentsave']);

    //--------------------------------------afficherliste_incident------------------------------//
        Route::get('/incident', [IncidentController::class, 'indexIncident']);

    //--------------------------------------Classer_un_incident_sans_suite------------------------------//
        Route::post('/classement-sans-suite/{id}', [IncidentController::class, 'classementSansSuite']);

    //--------------------------------------Marquer_un_incident_comme_résolu------------------------------//
        // Route::post('/resolution_incident/{idincident}', [IncidentController::class, 'marquerCommeResolu'])->name('resolution_incident');
        // Route::post('/resolution_incident/{idincident}', [LeBonCoinController::class, "marquerCommeResolu"]);

    //--------------------------------------?_un_incident------------------------------//
        // Route::get('/incidents', [LeBonCoinController::class,'indexIncidentprop'])->name('incidents.index');
    //--------------------------------------Afficher_incident_comme_résolu------------------------------//
        Route::get('/resolution/{id}', [IncidentController::class, 'resolution']);
    
    //--------------------------------------Dans_aucun_controller------------------------------//
        //Route::post('/changer-statut/{id}', [LeBonCoinController::class, 'changer-statut']);
//

//_______________________________________________.USER_CONTROLLER.___________________________________________________//
    //--------------------------------------Redirection_vers_compte------------------------------//
        Route::get("/compte",[UserController::class, "compte" ]);
    //--------------------------------------Modifier_son_compte------------------------------//
        Route::post('/updateUserInfo', [UserController::class, 'updateUserInfo'])->name('updateUserInfo');
    //--------------------------------------Créer_un_compte_particulier------------------------------//
        Route::get("/createaccountparticulier", [ UserController::class, "createaccountparticulier"]);
    //--------------------------------------Créer_un_compte_particulier------------------------------//
        Route::get("/createaccountentreprise", [ UserController::class, "createaccountentreprise"]);
    //--------------------------------------Se_deconnecter_du_compte------------------------------//
        Route::post('/logout', function () {
            Auth::logout();
            return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=');
        })->name('logout');
//

//_______________________________________________.CREATEACCOUNT_CONTROLLER.___________________________________________________//
    //--------------------------------------creation_compte------------------------------//
        Route::get("/createaccount",[ CreateAccountController::class, "createaccount" ]);
    //--------------------------------------Sauvegarde_compte_particulier------------------------------//
        Route::post("/saveaccount", [ CreateAccountController::class, "save"]);
    //--------------------------------------Sauvegarde_compte_entreprise------------------------------//
        Route::post("/saveentaccount", [ CreateAccountController::class, "saveent"])->name('saveent');
//

//_______________________________________________.LOGIN_CONTROLLER.___________________________________________________//
    //--------------------------------------Connexion_compte------------------------------//
        Route::get("/login",[LoginController::class, "authenticate" ]);
//

//_______________________________________________.RECHERCHE_CONTROLLER.___________________________________________________//
    //--------------------------------------Recupérer_infos_annonce_grace_a_un_id------------------------------//
        Route::get("/annoncelist/{id}",[RechercheController::class, "oneann" ]);
    //--------------------------------------Recherche_par_filtres------------------------------//
        Route::get('/annonce-filtres', [RechercheController::class, 'indexe'])->name('annonce-index');
    //--------------------------------------Recherche_par_filtres_dans_la_carte------------------------------//
        Route::get('/carte', [RechercheController::class, 'carteFiltre'])->name('annonce-carte');
    //--------------------------------------Récupérer_annonce_dans_la_carte------------------------------//
        Route::match(['get', 'post'], '/get-annonces', [RechercheController::class, 'getAnnonces'])->name('get-annonces');
    //--------------------------------------Voir_mes_recherches------------------------------//
        Route::get('/mes_recherches', [RechercheController::class, 'mes_recherches']);
    //--------------------------------------Barre_de_recherche------------------------------//
        Route::get("/search", [RechercheController::class, "indexe"]);
    //--------------------------------------Recherches------------------------------//
        Route::post('/search', [RechercheController::class, 'indexe'])->name('search');
        Route::get('/search', [RechercheController::class, 'indexe']);
    //--------------------------------------Sauvergarde_recherche------------------------------//
        Route::post('/sauvrecherche', [RechercheController::class, 'sauvrecherche'])->name('sauvrecherche');

//

//_______________________________________________.SERVICE_CONTROLLER.___________________________________________________//
    //--------------------------------------Service_global------------------------------//
        Route::post("oneann",[ServiceController::class, "oneann" ])->name("oneann");
    //--------------------------------------Service_immobilier------------------------------//
        Route::get('/serviceimmobilier', [ServiceController::class, 'serviceimmobilier']);
    //--------------------------------------Service_validateann------------------------------//
        //Route::post('/serviceimmoilier/validateann', [ServiceController::class, 'validateann']);
        //Route::post("/annonce/{id}",[ServiceController::class, "validateann" ]);
    //--------------------------------------Recevoir_les_(nv)_types_d'hebergement_ou_les_(nv)_equipements------------------------------//
        Route::get('/createheb', [ServiceController::class, 'createheb'])->name('createheb');
    //--------------------------------------Ajouter_un_nv_equipement------------------------------//
        Route::post('/createheb', [ServiceController::class, 'ajoutequ'])->name('ajoutequ');
    //--------------------------------------Ajouter_un_nv_type_hebergement------------------------------//
        //Route::post('/createheb', [ServiceController::class, 'createheb'])->name('createheb');
        Route::post('/ajoutheb', [ServiceController::class, 'ajoutheb'])->name('ajoutheb');
    //--------------------------------------Afficher_les_inscriptions_en_attente------------------------------//
        Route::get('/inscription-attente', [ServiceController::class, 'afficherInscriptionAttente']);
    
//

//_______________________________________________.CENTRE_D'AIDE___________________________________________________//
    //--------------------------------------redirection------------------------------//
        Route::get('/aide', [AideController::class, 'aide']);
        Route::get('/aidecompte', [AideController::class, 'aidecompte']);
        Route::get('/aidecookie', [AideController::class, 'aidecookie']);
        Route::get('/aideannonce', [AideController::class, 'aideannonce']);
        Route::get('/aideres', [AideController::class, 'aideres']);
        Route::get('/aiderecherche', [AideController::class, 'aiderecherche']);
        Route::get('/creercompte', [AideController::class, 'creercompte']);
        Route::get('/cocompte', [AideController::class, 'cocompte']);
        Route::get('/gererann', [AideController::class, 'gererann']);
        Route::get('/gererres', [AideController::class, 'gererres']);
        Route::get('/gererinci', [AideController::class, 'gererinci']);
        Route::get('/gererfav', [AideController::class, 'gererfav']);
        Route::get('/gererbanc', [AideController::class, 'gererbanc']);
        Route::get('/gererinfo', [AideController::class, 'gererinfo']);
        Route::get('/modifinfo', [AideController::class, 'modifinfo']);
        Route::get('/deco', [AideController::class, 'deco']);
        Route::get('/fairerech', [AideController::class, 'fairerech']);
        Route::get('/sauvrech', [AideController::class, 'sauvrech']);
        Route::get('/voircarte', [AideController::class, 'voircarte']);
        Route::get('/depann', [AideController::class, 'depann']);
        Route::get('/proprioann', [AideController::class, 'proprioann']);
        Route::get('/partageann', [AideController::class, 'partageann']);
        Route::get('/depavis', [AideController::class, 'depavis']);
        Route::get('/sauvann', [AideController::class, 'sauvann']);
        Route::get('/infoann', [AideController::class, 'infoann']);
        Route::get('/rechloc', [AideController::class, 'rechloc']);
        Route::get('/rechheb', [AideController::class, 'rechheb']);
        Route::get('/resann', [AideController::class, 'resann']);
        Route::get('/resprob', [AideController::class, 'resprob']);
        Route::get('/resrefu', [AideController::class, 'resrefu']);
//

//_______________________________________________.DROIT.___________________________________________________//
    //--------------------------------------redirection------------------------------//
        Route::get('/cookie', [DroitController::class, 'cookie']);
        Route::get('/politique', [DroitController::class, 'politique']);
        Route::get('/registre', [DroitController::class, 'registre']);
        Route::get('/contrat', [DroitController::class, 'contrat']);
        Route::get('/mesinfoperso', [DroitController::class, 'mesinfoperso']);
        Route::POST('/supprinfo', [DroitController::class, 'supprinfo']);
//

//_______________________________________________.AVIS.___________________________________________________//
    //--------------------------------------Deposer_un_avis------------------------------//
        Route::post('/annonce/deposerAvis', [AnnonceController::class, 'deposerAvis']);
    //--------------------------------------Enregistrer_un_avis------------------------------//
        Route::get('/enregistrer_avis', [AnnonceController::class, 'gestionAvis']);
    //--------------------------------------Modifier_un_avis------------------------------//
        Route::post('/modifierAvis/{id}', [AnnonceController::class, 'modifierAvis']);

//

//_______________________________________________.RESERVATION_CONTROLLER.___________________________________________________//
    //--------------------------------------Recupérer_infos_reservation_grace_a_un_id------------------------------//
        Route::get("/reservationlist/{id}",[ReservationController::class, "oneres" ]);
    //--------------------------------------Récupérer_réservation_lié_à_une_annonce------------------------------//
        Route::get("/reservation/{id}",[ReservationController::class, "reservation" ]);
    //--------------------------------------Récupérer_données_annonce_pour_créer_une_nouvelle_reservation------------------------------//
        Route::get('/newreservation', [ReservationController::class, 'newres']);
    //--------------------------------------Route_pour_enregistrer/Ajouter_la_nouvelle_réservation------------------------------//
        Route::post('/addreservation/{id}', [ReservationController::class, 'ajouterReservation'])->name('addreservation');
    //--------------------------------------Afficher_le_formulaire_de_réservation------------------------------//
        Route::get('/newreservation/{idannonce}', [ReservationController::class, 'showReservationForm'])->name('showreservationform');
    //--------------------------------------Afficher_le_formulaire_de_payement------------------------------//
        Route::get('/payement/{idannonce}', [ReservationController::class,'showPayementForm'])->name('payement');
    //--------------------------------------Régler_payement_réservation------------------------------//
        Route::post('/payement/{id}', [ReservationController::class, 'payement'])->name('payement');
    

//

//_______________________________________________.IMAGE_GLISSER_DEPOSER->(abandonné).___________________________________________________//
    //------------------------------------Global-------------------------------------//
        Route::get("/imgGP",[ImgGDController::class, "imgGP" ]);
        Route::get('/upload', [ImgGDController::class, 'showForm']);
        //Route::post('/compte', [ImgGDController::class, 'upload'])->name('upload');
//

//_______________________________________________.FAVORIS_CONTROLLER.___________________________________________________//
    //------------------------------------Afficher_favoris-------------------------------------//
        Route::get('/favoris/{id}', [FavorisController::class, 'favoris']);
    //------------------------------------Ajouter_favoris-------------------------------------//
        Route::get('/sauvefavoris/{id}', [FavorisController::class, 'sauvefavoris']);
    //------------------------------------Supprimer_favoris-------------------------------------//
        Route::get('/supprfavoris/{id}', [FavorisController::class, 'supprfavoris']);
//

//_______________________________________________.INFOSBANCAIRES_CONTROLLER.___________________________________________________//
    //------------------------------------Global-------------------------------------//
        Route::get('/mes-infos-bancaires', [InfosBancairesController::class, 'cryptInfosBc'])->name('mes-infos-bancaires');
        Route::post('/mes-infos-bancaires', [InfosBancairesController::class, 'encrypt'])->name('encrypt');
//

//_______________________________________________.DISCUSSION_CONTROLLER.___________________________________________________//
    //------------------------------------Global-------------------------------------//
        Route::get('/mes_messages', [DiscussionController::class, 'mes_messages']);
//

//_________________________________________________.BOTMAN._______________________________________//

Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');
